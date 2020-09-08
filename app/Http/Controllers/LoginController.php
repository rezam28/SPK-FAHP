<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function postlogin(request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $data = Admin::where('email',$email)->first();
        if($data){ //apakah email tersebut ada atau tidak
            if(Hash::check($password,$data->password)){
                //Session::put('data',$data);
                Session::put('nama',$data->nama);
                //Session::put('email',$data->email);
                Session::put('login',TRUE);
                return redirect('admin');
            }
            else{
                return redirect('login')->with('alert','Password atau Email');
            }
        }
        else{
            return redirect('login')->with('alert','Password atau Email, Salah!');
        }
    }

    public function logout(){
        //Auth::Logout();
        Session::flush();
        return redirect('login')->with('alert','Kamu sudah logout');
    }
}
