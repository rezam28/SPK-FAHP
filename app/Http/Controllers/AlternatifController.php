<?php

namespace App\Http\Controllers;


use DB;
use DataTables;
use App\Models\Alternatif;
use Illuminate\Http\Request;

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
            return DataTables::of($alternatif)->make(true);
        }
        //return response()->json($alternatif);
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

            if($request->action == 'delete')
    		{
    			DB::table('alternatif')
    				->where('id', $request->id)
    				->delete();
    		}
            return response()->json($request);
        }
    }
}
