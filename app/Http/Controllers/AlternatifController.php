<?php

namespace App\Http\Controllers;


use DB;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        return view('alternatif');
    }

    public function admin()
    {
        $alternatif = DB::table('alternatif')->get();
        return view('admin.alternatif', compact('alternatif'));
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == 'edit') {
                $data = array(
                    'nama_alternatif' => $request -> nama_alternatif,
                    'deskripsi' => $request -> deskripsi
                );
                DB::table('alternatif')
    				->where('id', $request->id)
    				->update($data);
            }
            return response()->json($request);
        }
    }
}
