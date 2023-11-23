<?php

namespace App\Http\Controllers;

use App\Models\Locales;
use App\Http\Requests\StoreLocalesRequest;
use App\Http\Requests\UpdateLocalesRequest;
use App\Http\Resources\LocalesCollection;

class LocalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }
    //Get
    public function findLocal($id){
        $Locales = Locales::find($id);
        return new LocalesCollection($Locales);
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
    public function store(StoreLocalesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Locales $Locales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locales $Locales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocalesRequest $request, Locales $Locales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locales $Locales)
    {
        //
    }
}
