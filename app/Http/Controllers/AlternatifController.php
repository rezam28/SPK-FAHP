<?php

namespace App\Http\Controllers;


use DB;
use DataTables;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class AlternatifController extends Controller
{
    public function index()
    {
        return view('alternatif');
    }

    public function admin(Request $request)
    {
        $alternatif = Alternatif::all();
        if ($request->ajax()) {
            return DataTables::of($alternatif)
            ->addColumn('aksi', function($data){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-warning btn-sm edit-alternatif"><i class="fa fa-pencil"></i> Edit</a>';
                $btn .= '&nbsp';'&nbsp';
                $btn .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('admin.alternatif');
    }

    public function store(Request $request)
    {
        //$id = $request ->id;
        $post = Alternatif::updateOrCreate(['id' => $request->alternatif_id],
            [   
                'Kode' => $request->kode,
                'nama_alternatif' => $request->nama_alternatif, 
                'deskripsi' => $request->deskripsi
            ]);        
        return response()->json($post);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $post  = Alternatif::where($where)->first();
     
        return response()->json($post);
    }

    public function destroy($id)
    {
        Alternatif::find($id)->delete();
        return response()->json();

    }
}
