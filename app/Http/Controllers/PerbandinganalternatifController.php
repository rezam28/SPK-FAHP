<?php

namespace App\Http\Controllers;

use App\Models\Perbandinganalternatif;
use Illuminate\Http\Request;

class PerbandinganalternatifController extends Controller
{
    public function admin()
    {
        return view('admin.perbandingan_alternatif');
    }   
}
