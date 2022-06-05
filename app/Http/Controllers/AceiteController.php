<?php

namespace App\Http\Controllers;

use App\Aceite;
use Illuminate\Http\Request;

class AceiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('aceite.index');
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
     * @param  \App\Aceite  $aceite
     * @return \Illuminate\Http\Response
     */
    public function show(Aceite $aceite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aceite  $aceite
     * @return \Illuminate\Http\Response
     */
    public function edit(Aceite $aceite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aceite  $aceite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aceite $aceite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aceite  $aceite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aceite $aceite)
    {
        //
    }
}
