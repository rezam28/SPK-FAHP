<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class KriteriaController extends Controller
{
    public function index()
    {
        return view('kriteria');
    }

    public function admin(Request $request)
    {
        $kriteria = Kriteria::all();
        if ($request->ajax()) {
            return DataTables::of($kriteria)
            ->addColumn('aksi', function($data){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit-kriteria"><i class="fa fa-pencil"></i> Edit</a>';
                $btn .= '&nbsp';'&nbsp';
                $btn .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('admin.kriteria',compact('kriteria',$kriteria));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //$id = $request ->id;
        $post = Kriteria::updateOrCreate(['id' => $request->kriteria_id],
            [   
                'Kode' => $request->kode,
                'nama_kriteria' => $request->nama_kriteria, 
                'deskripsi' => $request->deskripsi
            ]);        
        return response()->json($post);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Kriteria::where($where)->first();
     
        return response()->json($post);
    }

    public function destroy($id)
    {
        Kriteria::find($id)->delete();
        return response()->json();

    }
}


