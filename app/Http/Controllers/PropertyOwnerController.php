<?php

namespace App\Http\Controllers;

use App\Models\PropertyOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

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
    public function edit($id)
    {
        $propertyOwner = PropertyOwner::findOrFail($id);
        return view('dashboard.owner.profile.edit', ['propertyOwner' => $propertyOwner]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyOwner  $propertyOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator($request->all(), [
            'name' => 'required | string ',
            'email' => 'required | string |max:50',
            'phone' => 'required | numeric ',
        ]);
        if (!$validator->fails()) {
            $propertyOwner = PropertyOwner::findOrFail($id);
            $propertyOwner->name = $request->input('name');
            $propertyOwner->email = $request->input('email');
            $propertyOwner->phone = $request->input('phone');
            $propertyOwner->password = Hash::make($request->input('password'));
            $isSaved = $propertyOwner->save();

            return response()->json(
                [
                    'message' => $isSaved ? 'Owner updated successfully' : 'updated failed!'
                ],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
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
