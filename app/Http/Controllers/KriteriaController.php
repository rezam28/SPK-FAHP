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
            ->addColumn('aksi', function($row){
                return '<button type="button" id="btn-edit" class="btn btn-warning btn-lg fa fa-pencil" data-toggle="modal" data-target="#modal-tambah">Edit</button>
                        <button type="button" id="btn-delete" class="btn btn-danger btn-lg fa fa-trash" data-toggle="modal" data-target="#modal-tambah">&nbspDelete</button>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('admin.kriteria');
    }
}
