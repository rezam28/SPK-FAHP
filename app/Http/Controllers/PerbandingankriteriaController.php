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
        if ($request->ajax()) {
            return DataTables::of($perbandingan)->make(true);
        }
        //return json_encode($perbandingan);
        return view('admin.perbandingan_kriteria',compact('kriteria',$kriteria,
                                                          'perbandingan',$perbandingan,
                                                          'daerah',$daerah
        ));
    }
    public function daerah($daerah)
    {
        if($daerah==0){
            $post = Perbandingankriteria::all();
        }else{
            $post = Perbandingankriteria::where('daerah_id','=',$daerah)->get();
        }
        return response()->json($post);
    }

    public function store(Request $request)
    {
        $data = Perbandingankriteria::updateOrCreate(['daerah_id' => $request->daerah, 'kriteria1_id' => $request->kriteria1,'kriteria2_id' => $request->kriteria2],
            [
                'daerah_id' => $request->daerah,
                'kriteria1_id' => $request->kriteria1,
                'nilai' => $request->nilai,
                'kriteria2_id' => $request->kriteria2
            ]
        );

        return response()->json($data);
    }
}
