<?php


namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Daerah;
use App\Models\Kriteria;
use App\Models\Perbandinganalternatif;
use App\Models\Perbandingankriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use App\Http\Requests\CreateHasilRequest;

class HasilController extends Controller
{
    // public function __construct() {
    //     $this->middleware('admin');
    // }

    public function index()
    {
        $daerah = Daerah::all();
        $alternatif = Alternatif::all();
        return view('hasil',compact('alternatif', $alternatif,
                                    'daerah', $daerah
        ));
    }

    public function hasil(Request $request)
    {
        $daerah = Daerah::all();
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $perbandinganalternatif = Perbandinganalternatif::all();
        $perbandingankriteria = Perbandingankriteria::all();

        $messages = [
            'required' => 'Mohon Dipilih',
            'alternatif.min' => 'Harus Memilih Lebih Dari 1',
        ];

        $validator = Validator::make($request->all(), [
            'daerah' => 'required',
            'alternatif' => 'required|min:2',
        ],$messages);
       
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $perkriteria = Perbandingankriteria::where('daerah_id', $request->daerah)->get();
        $countkriteria = count($kriteria);
        $countperkriteria = count($perkriteria);

        // Matrik kriteria AHP
        foreach ($kriteria as $baris ) {
            foreach ($kriteria as $kolom ) {
                foreach ($perkriteria as $value ) {
                    if ($baris->kode == $value->kriteria1->kode && $kolom->kode == $value->kriteria2->kode) {
                        $matrikahp[] =  $value->nilai;
                    }
                }
            }
            $jumlahahp[] = array_sum($matrikahp);
            $matrikahp = array();
        }

        //Matrik kriteria Fuzzy AHP
        foreach ($kriteria as $baris ) {
            foreach ($kriteria as $kolom ) {
                foreach ($perkriteria as $value ) {
                    if ($baris->kode == $value->kriteria1->kode && $kolom->kode == $value->kriteria2->kode) {
                        if ($value->nilai == 1 || 1/$value->nilai == 1) {
                            $matrikfahapl[] = 1;
                            $matrikfahapm[] = 1;
                            $matrikfahapu[] = 1;
                        }elseif ($value->nilai == 2) {
                            $matrikfahapl[] = 1/2;
                            $matrikfahapm[] = 1;
                            $matrikfahapu[] = 3/2;
                        }
                        elseif ($value->nilai == 1/2) {
                            $matrikfahapl[] = 2/3;
                            $matrikfahapm[] = 1;
                            $matrikfahapu[] = 2;
                        }
                        elseif ($value->nilai == 3) {
                            $matrikfahapl[] = 1;
                            $matrikfahapm[] = 3/2;
                            $matrikfahapu[] = 2;
                        }
                        elseif ($value->nilai == 1/3) {
                            $matrikfahapl[] = 1/2;
                            $matrikfahapm[] = 2/3;
                            $matrikfahapu[] = 1;
                        }
                        elseif ($value->nilai == 4) {
                            $matrikfahapl[] = 3/2;
                            $matrikfahapm[] = 2;
                            $matrikfahapu[] = 5/2;
                        }
                        elseif ($value->nilai == 1/4) {
                            $matrikfahapl[] = 2/5;
                            $matrikfahapm[] = 1/2;
                            $matrikfahapu[] = 2/3;
                        }
                        elseif ($value->nilai == 5) {
                            $matrikfahapl[] = 2;
                            $matrikfahapm[] = 5/2;
                            $matrikfahapu[] = 3;
                        }
                        elseif ($value->nilai == 1/5) {
                            $matrikfahapl[] = 1/3;
                            $matrikfahapm[] = 2/5;
                            $matrikfahapu[] = 1/2;
                        }
                        elseif ($value->nilai == 6) {
                            $matrikfahapl[] = 5/2;
                            $matrikfahapm[] = 3;
                            $matrikfahapu[] = 7/2;
                        }
                        elseif ($value->nilai == round(1/6)) {
                            $matrikfahapl[] = 2/7;
                            $matrikfahapm[] = 1/3;
                            $matrikfahapu[] = 2/5;
                        }
                    }
                }
            }
            $barissi[] = $baris->kode;
            $jumlahfahapl[] = array_sum($matrikfahapl);
            $jumlahfahapm[] = array_sum($matrikfahapm);
            $jumlahfahapu[] = array_sum($matrikfahapu);
            $matrikfahapl = array();
            $matrikfahapm = array();
            $matrikfahapu = array();
        }
        $sumnilail = array_sum($jumlahfahapl);
        $sumnilaim = array_sum($jumlahfahapm);
        $sumnilaiu = array_sum($jumlahfahapu);

        // Nilai SI
        foreach ($jumlahfahapl as $value) {
            $nilaisil[] = $value*(1/$sumnilaiu);
        }

        foreach ($jumlahfahapm as $value) {
            $nilaisim[] = $value*(1/$sumnilaim);
        }

        foreach ($jumlahfahapu as $value) {
            $nilaisiu[] = $value*(1/$sumnilail);
        }
        
        $test = [
            'jumlahnilail' => $jumlahfahapl,        //jumlah nilai l
            'jumlahnilaim' => $jumlahfahapm,
            'jumlahnilaiu' => $jumlahfahapu,
            'l' => $nilaisil,
            'm' => $nilaisim,
            'u' => $nilaisiu
        ];

        $data = [
            //nilai SI
            'barissi' => $barissi,                  //Jumlah kriteria
            'jumlahnilail' => $jumlahfahapl,        //jumlah nilai l
            'jumlahnilaim' => $jumlahfahapm,
            'jumlahnilaiu' => $jumlahfahapu,
            'sumnilail' => $sumnilail,              //nilai jumlah dari jumlahnilail
            'sumnilaim' => $sumnilaim,
            'sumnilaiu' => $sumnilaiu,
            'nilaisil' => $nilaisil,                //Nilai si L
            'nilaisim' => $nilaisim,
            'nilaisiu' => $nilaisiu
        ];
        // dd($data);
        //dd($barissi);
        // dd($test);
        // dd($jumlahfahapl);
        
        return view('hasilranking',compact('kriteria', $kriteria, 
                                    'alternatif', $alternatif,
                                    'daerah', $daerah,
                                    'perkriteria',$perkriteria,
                                    'data'
        ));
    }
}
