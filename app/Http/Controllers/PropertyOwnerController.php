<?php

namespace App\Http\Controllers;

use App\Models\PropertyOwner;
use Illuminate\Http\Request;

class PropertyOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.owner.compound.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.owner.compound.create');
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
     * @param  \App\Models\PropertyOwner  $propertyOwner
     * @return \Illuminate\Http\Response
     */
    public function show(PropertyOwner $propertyOwner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyOwner  $propertyOwner
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyOwner $propertyOwner)
    {
        return view('dashboard.owner.compound.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyOwner  $propertyOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PropertyOwner $propertyOwner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyOwner  $propertyOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyOwner $propertyOwner)
    {
        //
    }
}
