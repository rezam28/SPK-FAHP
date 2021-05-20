<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Daerah;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $daerah = Daerah::all();
        return view('daerah',compact('daerah',$daerah));
    }

    public function admin(Request $request)
    {
        $daerah = Daerah::all();
        if ($request->ajax()) {
            return DataTables::of($daerah)
            ->addColumn('aksi', function($data){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit-daerah"><i class="fa fa-pencil"></i> Edit</a>';
                $btn .= '&nbsp';'&nbsp';
                $btn .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('admin.daerah',compact('daerah',$daerah));
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
        $post = Daerah::updateOrCreate(['id' => $request->daerah_id],
            [   
                'nama_daerah' => $request->nama_daerah,
                'lat' => $request->latitude,
                'lng' =>$request->longitude
            ]);        
        return response()->json($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Daerah::where($where)->first();
     
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Daerah::find($id)->delete();
        return response()->json();

    }
}
