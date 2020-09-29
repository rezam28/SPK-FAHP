<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Perbandingankriteria;
use Illuminate\Http\Request;

class PerbandingankriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function admin()
    {
        $kriteria = Kriteria::all();
        return view('admin.perbandingan_kriteria',compact('kriteria',$kriteria));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perbandingankriteria  $perbandingankriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Perbandingankriteria $perbandingankriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perbandingankriteria  $perbandingankriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Perbandingankriteria $perbandingankriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perbandingankriteria  $perbandingankriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perbandingankriteria $perbandingankriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perbandingankriteria  $perbandingankriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perbandingankriteria $perbandingankriteria)
    {
        //
    }
}
