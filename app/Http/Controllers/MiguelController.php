<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MiguelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo "Si llego al index";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        echo "Hola desde {$id}";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function testingView($id, $name, $two){
        // echo "esto es {$id}";
        return view('testing/testing', compact('id','name','two'));
    }
}
