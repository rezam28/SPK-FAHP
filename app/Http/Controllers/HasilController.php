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
use Illuminate\Support\Arr;

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
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        $daerah = Daerah::where('id',$request->daerah)->pluck('nama_daerah');
        
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
        // foreach ($kriteria as $baris ) {
        //     foreach ($kriteria as $kolom ) {
        //         foreach ($perkriteria as $value ) {
        //             if ($baris->kode == $value->kriteria1->kode && $kolom->kode == $value->kriteria2->kode) {
        //                 $matrikahp[] =  $value->nilai;
        //             }
        //         }
        //     }
        //     $jumlahahp[] = array_sum($matrikahp);
        //     $matrikahp = array();
        // }

        //Matrik kriteria Fuzzy AHP
        foreach ($kriteria as $baris ) {
            $matrikfahapl = [];
            $matrikfahapm = [];
            $matrikfahapu = [];
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
                        elseif ($value->nilai == round(1/3,3)) {
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
                        elseif ($value->nilai == round(1/6,3)) {
                            $matrikfahapl[] = 2/7;
                            $matrikfahapm[] = 1/3;
                            $matrikfahapu[] = 2/5;
                        }
                        elseif ($value->nilai == 7) {
                            $matrikfahapl[] = 3;
                            $matrikfahapm[] = 7/2;
                            $matrikfahapu[] = 4;
                        }
                        elseif ($value->nilai == round(1/7,3)) {
                            $matrikfahapl[] = 1/4;
                            $matrikfahapm[] = 2/7;
                            $matrikfahapu[] = 1/3;
                        }
                    }
                }
            }
            $kodekriteria[] = $baris->kode;
            $namakriteria[] = $baris->nama_kriteria;
            $jumlahfahapl[] = array_sum($matrikfahapl);
            $jumlahfahapm[] = array_sum($matrikfahapm);
            $jumlahfahapu[] = array_sum($matrikfahapu);
        }
        $sumnilail = array_sum($jumlahfahapl);
        $sumnilaim = array_sum($jumlahfahapm);
        $sumnilaiu = array_sum($jumlahfahapu);

        // Nilai SI
        foreach ($jumlahfahapl as $value) {
            $nilaisil[] = ($sumnilaiu > 0) ? $value*(1/$sumnilaiu) : 0;
        }

        foreach ($jumlahfahapm as $value) {
            $nilaisim[] = ($sumnilaim > 0) ? $value*(1/$sumnilaim) : 0;
        }

        foreach ($jumlahfahapu as $value) {
            $nilaisiu[] = ($sumnilail > 0) ? $value*(1/$sumnilail) : 0;
        }
        
        $sil[] = $nilaisil;
        $sim[] = $nilaisim;
        $siu[] = $nilaisiu;
        $si = [
            'l' => $nilaisil,
            'm' => $nilaisim,
            'u' => $nilaisiu
        ];

        //Nilai Defuzzifikasi

        foreach ($si['m'] as $no => $isi) {
            $defuzzy = [];
            foreach ($si['m'] as $key => $value) {
                if ($no != $key) {
                    
                    if ($si['m'][$no] >= $si['m'][$key]) {
                        $defuzzy[] = 1;
                    }elseif ($si['l'][$key] >= $si['u'][$no]) {
                        $defuzzy[] = 0;
                    }else {        
                        $defuzzy[] = ( $si['l'][$key]-$si['u'][$no] ) / (( $si['m'][$no]-$si['u'][$no] ) - ( $si['m'][$key]-$si['l'][$key] ));                        
                    }
                }else{
                    $defuzzy[] = 5;
                }
            }
            $defuzzyarray[] = $defuzzy;
            $vektor[] = min($defuzzy);
        }
        $sumvektor = array_sum($vektor);
        

        //Nilai Bobot Kriteria

        foreach ($vektor as $key => $value) {
            $bobot[] = $value/$sumvektor;
        }


        //Perhitungan Alternatif
        $selectalter = $request->input('alternatif');            //alternatif yang dipilih

        $kodealter = Alternatif::whereIn('id',$selectalter)->pluck('kode');
        $namaalter = Alternatif::whereIn('id',$selectalter)->pluck('nama_alternatif');
        
        foreach ($kriteria as $key => $value) {
            $peralternatif[] = Perbandinganalternatif::where('daerah_id',$request->daerah)->where('nama_kriteria',$value->id)->whereIn('alternatif1_id',$selectalter)->whereIn('alternatif2_id',$selectalter)->get();
        }
        foreach ($selectalter as $key => $value) {
            $selected[] = $value; 
        }

        

        foreach ($kriteria as $no => $isi) {
            
            // Matrik Fuzzyahp
            foreach ($kodealter as $nb => $baris) {
                $l = [];
                $m = [];
                $u = [];
                foreach ($kodealter as $nk => $kolom) {
                    foreach ($peralternatif[$no] as $key => $value) {
                        if ($baris == $value->alternatif1->kode && $kolom == $value->alternatif2->kode) {
                            if ($value->nilai == 1 || 1/$value->nilai == 1) {
                                $l[] = 1;
                                $m[] = 1;
                                $u[] = 1;
                            }elseif ($value->nilai == 2) {
                                $l[] = 1/2;
                                $m[] = 1;
                                $u[] = 3/2;
                            }
                            elseif ($value->nilai == 1/2) {
                                $l[] = 2/3;
                                $m[] = 1;
                                $u[] = 2;
                            }
                            elseif ($value->nilai == 3) {
                                $l[] = 1;
                                $m[] = 3/2;
                                $u[] = 2;
                            }
                            elseif ($value->nilai == round(1/3,3)) {
                                $l[] = 1/2;
                                $m[] = 2/3;
                                $u[] = 1;
                            }
                            elseif ($value->nilai == 4) {
                                $l[] = 3/2;
                                $m[] = 2;
                                $u[] = 5/2;
                            }
                            elseif ($value->nilai == 1/4) {
                                $l[] = 2/5;
                                $m[] = 1/2;
                                $u[] = 2/3;
                            }
                            elseif ($value->nilai == 5) {
                                $l[] = 2;
                                $m[] = 5/2;
                                $u[] = 3;
                            }
                            elseif ($value->nilai == 1/5) {
                                $l[] = 1/3;
                                $m[] = 2/5;
                                $u[] = 1/2;
                            }
                            elseif ($value->nilai == 6) {
                                $l[] = 5/2;
                                $m[] = 3;
                                $u[] = 7/2;
                            }
                            elseif ($value->nilai == round(1/6,3)) {
                                $l[] = 2/7;
                                $m[] = 1/3;
                                $u[] = 2/5;
                            }
                            elseif ($value->nilai == 7) {
                                $l[] = 3;
                                $m[] = 7/2;
                                $u[] = 4;
                            }
                            elseif ($value->nilai == round(1/7,3)) {
                                $l[] = 1/4;
                                $m[] = 2/7;
                                $u[] = 1/3;
                            }
                        }
                    }                    
                }
                // $test[$no][] = array_sum($l);               
                // $coba[$no] = array_sum($test[$no]);         
                $jmlbarisalterl[$no][] = array_sum($l);                     //jumlah baris
                $jmlbarisalterm[$no][] = array_sum($m);
                $jmlbarisalteru[$no][] = array_sum($u);

                $sumjmlbarisl[$no] = array_sum($jmlbarisalterl[$no]);       //Jumlah baris total
                $sumjmlbarism[$no] = array_sum($jmlbarisalterm[$no]);       //Jumlah baris total
                $sumjmlbarisu[$no] = array_sum($jmlbarisalteru[$no]);       //Jumlah baris total
            }
            
            // Nilai SI Alternatif
            foreach ($jmlbarisalterl[$no] as $value) {
                $nilaialtersil[$no][] = ($sumjmlbarisu[$no] > 0) ? $value*(1/$sumjmlbarisu[$no]) : 0;
            }

            foreach ($jmlbarisalterm[$no] as $value) {
                $nilaialtersim[$no][] = ($sumjmlbarism[$no] > 0) ? $value*(1/$sumjmlbarism[$no]) : 0;
            }

            foreach ($jmlbarisalteru[$no] as $value) {
                $nilaialtersiu[$no][] = ($sumjmlbarisl[$no] > 0) ? $value*(1/$sumjmlbarisl[$no]) : 0;
            }
            
            $altersil[] = $nilaialtersil;
            $altersim[] = $nilaialtersim;
            $altersiu[] = $nilaialtersiu;
            $altersi = [
                'l' => $nilaialtersil,
                'm' => $nilaialtersim,
                'u' => $nilaialtersiu
            ];

            //Nilai Defuzzifikasi Alternatif

            foreach ($altersi['m'][$no] as $num => $isi) {
                $defuzzy = [];
                foreach ($altersi['m'][$no] as $key => $value) {
                    if ($num != $key) {
                        
                        if ($altersi['m'][$no][$num] >= $altersi['m'][$no][$key]) {
                            $defuzzy[] = 1;
                        }elseif ($altersi['l'][$no][$key] >= $altersi['u'][$no][$num]) {
                            $defuzzy[] = 0;
                        }else {        
                            $defuzzy[] = ( $altersi['l'][$no][$key]-$altersi['u'][$no][$num] ) / (( $altersi['m'][$no][$num]-$altersi['u'][$no][$num] ) - ( $altersi['m'][$no][$key]-$altersi['l'][$no][$key] ));                        
                        }
                    }else{
                        $defuzzy[] = 5;
                    }
                }
                $alterdefuzzyarray[$no][] = $defuzzy;
                $vektoralter[$no][] = min($defuzzy);
                // $coba[$no][] = $num;
            }
            $sumvektoralter = array_sum($vektoralter[$no]);

            // dd($sumvektoralter);


            //Nilai Bobot Kriteria

            foreach ($vektoralter[$no] as $key => $value) {
                $bobotalter[$no][] = $value/$sumvektoralter;
            }
        }

        //Hasil pembobotan Ranking
        foreach ($bobot as $key => $value) {
            foreach ($bobotalter[$key] as $no => $isi) {
                $result[$no][] = $isi*$value;
            }
        }

        foreach ($kodealter as $key => $value) {
            $hasil[$value] = array_sum($result[$key]);
        }

        $ranking = $hasil;
        arsort($ranking);

        
        
        
        
        // dd($ranking);

        $data = [
            //kriteria
            'kodekri' => $kodekriteria,                  //Jumlah kriteria / kode kriteria
            'namakri' => $namakriteria,
            'jumlahnilail' => $jumlahfahapl,        //jumlah nilai l
            'jumlahnilaim' => $jumlahfahapm,
            'jumlahnilaiu' => $jumlahfahapu,
            'sumnilail' => $sumnilail,              //nilai jumlah dari jumlahnilail
            'sumnilaim' => $sumnilaim,
            'sumnilaiu' => $sumnilaiu,
            'nilaisil' => $nilaisil,                //Nilai si L
            'nilaisim' => $nilaisim,
            'nilaisiu' => $nilaisiu,
            'defuzzy' => $defuzzyarray,             //nilai Defuzzifikasi
            'vektor' => $vektor,                     //Nilai Vektor
            'bobotkri' => $bobot,                    //Nilai Bobot Kriteria
            //alternatif
            'selected' => $selected,                //alternatif yang dipilih
            'kodealter' => $kodealter,              //kode alternatif yang dipilih
            'namaalter' => $namaalter,
            'jmlbarisalterl' =>$jmlbarisalterl,
            'jmlbarisalterm' => $jmlbarisalterm,
            'jmlbarisalteru' => $jmlbarisalteru,
            'sumjmlalterl' => $sumjmlbarisl,
            'sumjmlalterm' => $sumjmlbarism,
            'sumjmlalteru' => $sumjmlbarisu,
            'nilaialtersil' => $nilaialtersil,
            'nilaialtersim' => $nilaialtersim,
            'nilaialtersiu' => $nilaialtersiu,
            'alterdefuzzy' => $alterdefuzzyarray,
            'vektoralter' => $vektoralter,
            'bobotalter' => $bobotalter,
            //Hasil
            'hasil' =>$hasil,
            'ranking' => $ranking,
            'daerah' => $daerah
        ];
        // dd($data);
        // dd($test);
        // dd($cek);
        
        return view('hasilranking',compact('kriteria', $kriteria,
                                    'perkriteria',$perkriteria,
                                    'alternatif',$alternatif,
                                    'peralternatif',$peralternatif,
                                    'data'
        ));
    }
}
