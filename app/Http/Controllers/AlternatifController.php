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
            ->addColumn('aksi', function($row){
                return '<button type="button" id="btn-edit" class="btn btn-warning btn-lg fa fa-pencil" data-toggle="modal" data-target="#modal-tambah">Edit</button>
                        <button type="button" id="btn-delete" class="btn btn-danger btn-lg fa fa-trash" data-toggle="modal" data-target="#modal-tambah">&nbspDelete</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('admin.alternatif');
    }
    // public function action(Request $request)
    // {
    //     if ($request->ajax()) {
    //         if ($request->action == 'edit') {
    //             $data = array(
    //                 'nama_alternatif' => $request -> nama_alternatif,
    //                 'deskripsi' => $request -> deskripsi
    //             );
    //             DB::table('alternatif')
    // 				->where('id', $request->id)
    // 				->update($data);
    //         }

    //         if($request->action == 'delete')
    // 		{
    // 			DB::table('alternatif')
    // 				->where('id', $request->id)
    // 				->delete();
    // 		}
    //         return response()->json($request);
    //     }
    // }
}
