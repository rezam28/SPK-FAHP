<?php

namespace App\Http\Controllers;

use App\models\Daerah;
use App\Models\Kriteria;
use App\Models\Perbandingankriteria;
use Illuminate\Http\Request;

class PerbandingankriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function admin(Request $request)
    {
        $perbandingan = Perbandingankriteria::all();
        $kriteria = Kriteria::all();
        $daerah = Daerah::all();
        // if ($request->ajax()) {
        //     return DataTables::of($perbandingan)
        //     ->rawColumns(['aksi'])
        //     ->make(true);
        // }
        return view('admin.perbandingan_kriteria',compact('kriteria',$kriteria,
                                                          'perbandingan',$perbandingan,
                                                          'daerah',$daerah
        ));
    }
    public function daerah($daerah)
    {
        //$kriteria = Kriteria::all();
        // $nama_kriteria = $kriteria->pluck('nama_kriteria');
        // $kode = $kriteria->pluck('kode'); 
        
        if($daerah==0){
            $post = Perbandingankriteria::all();
        }else{
            $post = Perbandingankriteria::where('daerah_id','=',$daerah)->get();
        }
        // $response = [
        //     'kriteria' => $kriteria,
        //     'perbandingan' => $post
        // ];
        //return json_encode($response);
        return response()->json($post);
    }
}
