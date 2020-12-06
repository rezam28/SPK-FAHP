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
        if($kriteria==0){
            $post = Perbandinganalternatif::all();
        }else{
            $post = Perbandinganalternatif::where([['daerah_id','=',$daerah],['nama_kriteria','=',$kriteria],])->get();
        }
        return response()->json($post);
    }

    public function strore(Request $request)
    {
        # code...
    }

    public function destroy($id)
    {
        # code...
    }
}
