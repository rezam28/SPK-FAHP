<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Daerah;
use App\Models\Kriteria;
use App\Models\Perbandinganalternatif;
use Illuminate\Http\Request;
use PerAlternatifSeeder;

class PerbandinganalternatifController extends Controller
{
    public function admin()
    {
        $perbandingan = Perbandinganalternatif::all();
        $daerah = Daerah::all();
        $kriteria = Kriteria::all();
        $alternatif = Alternatif::all();
        return view('admin.perbandingan_alternatif',compact('alternatif',$alternatif,
                                                            'perbandingan',$perbandingan,
                                                            'daerah',$daerah,
                                                            'kriteria',$kriteria
        ));
    }   

    public function kriteria(Request $request)
    {
        $daerah = $request->daerah;
        $kriteria = $request->kriteria;
        $datakri = Kriteria::where('id','=',$kriteria)->get();
        $datadae = Daerah::where('id','=',$daerah)->get();

        $namakri = $datakri->pluck('nama_kriteria');
        $alternatif = Alternatif::all();
        if($kriteria==0 || $daerah == 0){
            $post = Perbandinganalternatif::where('daerah_id','=',$daerah)->orWhere('nama_kriteria','=',$kriteria)->get();
        }else{
            $post = Perbandinganalternatif::where([['daerah_id','=',$daerah],['nama_kriteria','=',$kriteria],])->get();
        }
        return response()->json(array(
            'post' => $post,
            'alternatif' => $alternatif,
            'kriteria' => $namakri,
            'daerah' => $datadae
        ));
    }

    public function store(Request $request)
    {
        if ($request->input("alternatif1") == $request->input("alternatif2")) {
            $data = Perbandinganalternatif::updateOrCreate(['daerah_id' => $request->daerah, 'nama_kriteria' => $request->kriteria, 'alternatif1_id' => $request->input("alternatif1"),'alternatif2_id' => $request->input("alternatif2")],
                    [
                        'daerah_id' => $request->daerah,
                        'kriteria1_id' => $request->input("kriteria1"),
                        'nilai' => $request->nilai,
                        'kriteria2_id' => $request->input("kriteria2")
                    ],
                );
        }else
        for ($i=1; $i<=2 ; $i++) { 
            if ($i = 1) {
                $data = Perbandinganalternatif::updateOrCreate(['daerah_id' => $request->daerah, 'nama_kriteria' => $request->kriteria, 'alternatif1_id' => $request->input("alternatif1"),'alternatif2_id' => $request->input("alternatif2")],
                    [
                        'daerah_id' => $request->daerah,
                        'nama_kriteria' => $request->kriteria,
                        'alternatif1_id' => $request->input("alternatif1"),
                        'nilai' => $request->nilai,
                        'alternatif2_id' => $request->input("alternatif2")
                    ],
                );
            }else{}
            if ($i = 2) {
                $data = Perbandinganalternatif::updateOrCreate(['daerah_id' => $request->daerah, 'nama_kriteria' => $request->kriteria, 'alternatif1_id' => $request->input("alternatif2"),'alternatif2_id' => $request->input("alternatif1")],
                    [
                        'daerah_id' => $request->daerah,
                        'nama_kriteria' => $request->kriteria,
                        'alternatif1_id' => $request->input("alternatif2"),
                        'nilai' => round(1/$request->input("nilai"),3),
                        'alternatif2_id' => $request->input("alternatif1")
                    ],
                );
            }else {}
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        Perbandinganalternatif::find($id)->delete();
        return response()->json();
    }
}
