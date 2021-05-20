<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Contracts\DataTable;
use App\Models\Daerah;
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
        $kriteria = Kriteria::all();
        return response()->json(array(
            'post' => $post,
            'kriteria' => $kriteria
        ));
    }

    public function store(Request $request)
    {
        $perkriteria = Perbandingankriteria::all();
        if ($request->input("kriteria1") == $request->input("kriteria2")) {
            $data = Perbandingankriteria::updateOrCreate(['daerah_id' => $request->daerah, 'kriteria1_id' => $request->input("kriteria1"),'kriteria2_id' => $request->input("kriteria2")],
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
                $data = Perbandingankriteria::updateOrCreate(['daerah_id' => $request->daerah, 'kriteria1_id' => $request->input("kriteria1"),'kriteria2_id' => $request->input("kriteria2")],
                    [
                        'daerah_id' => $request->daerah,
                        'kriteria1_id' => $request->input("kriteria1"),
                        'nilai' => $request->nilai,
                        'kriteria2_id' => $request->input("kriteria2")
                    ],
                );
            }else{}
            if ($i = 2) {
                $data = Perbandingankriteria::updateOrCreate(['daerah_id' => $request->daerah, 'kriteria1_id' => $request->input("kriteria2"),'kriteria2_id' => $request->input("kriteria1")],
                    [
                        'daerah_id' => $request->daerah,
                        'kriteria1_id' => $request->input("kriteria2"),
                        'nilai' => round(1/$request->input("nilai"),3),
                        'kriteria2_id' => $request->input("kriteria1")
                    ],
                );
            }else {}
        }
        return response()->json($data);
    }

    public function destroy($id)
    {
        Perbandingankriteria::find($id)->delete();
        return response()->json();

    }
}
