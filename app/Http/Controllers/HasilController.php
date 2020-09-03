<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index()
    {
        $data = null;
        return view('hasil')->with('data',$data);
    }

    public function hasil()
    {
        $data=[];
        if(isset($_POST['pilih'])){
            if(empty($_POST['alternatif'])){
                return redirect('hasil')->with('data',$data)
                                    ->with('alert','Mohon dipilih');
            }
            else{
                foreach($_POST['alternatif'] as $alternatif){  
                    $alternatif = $_POST['alternatif'];
                }
            }
            $data = $alternatif;
        }
        //var_dump($data);
        return view('hasil')->with('data',$data);
    }
}
