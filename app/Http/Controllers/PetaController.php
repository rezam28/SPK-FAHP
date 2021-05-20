<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Daerah;
use App\Models\Peta;
use Illuminate\Http\Request;

class PetaController extends Controller
{
    public function index()
    {
        $daerah = Daerah::all();
        $peta = Peta::all();
        return view('peta',compact('daerah', $daerah, 'peta',$peta));
    }

    public function admin(Request $request)
    {
        $daerah = Daerah::all();
        $peta = Peta::all();
        if ($request->ajax()) {
            return DataTables::of($peta)
            ->addColumn('aksi', function($data){
                $btn = '<a href="'.url('/admin/pemetaan/'.$data->id.'').'" data-toggle="tooltip"  data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-info btn-sm edit-daerah"><i class="fa fa-eye"></i> Lihat</a>';
                $btn .= '&nbsp';'&nbsp';
                $btn .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
        }
        return view('admin.pemetaan',compact('daerah', $daerah));
    }

    public function store(Request $request)
    {
        //$id = $request ->id;
        $post = Peta::updateOrCreate(['id' => $request->pemetaan_id],
            [   
                'daerah_id' => $request->input("daerah"),
                'keterangan' =>$request->keterangan
            ]);        
        return response()->json($post);
    }

    public function peta($id)
    {
        // dd($id);
        $peta = Peta::all();
        $data = $peta->find($id);
        return view('admin.peta',compact('data', $data));
    }

    public function update(Request $request)
    {
        $post = Peta::where('id', $request->id)->update(['keterangan' =>$request->keterangan]); 
        return redirect(route('ad_pemetaan'));
    }

    public function destroy($id)
    {
        Peta::find($id)->delete();
        return response()->json();

    }
}
