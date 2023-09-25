<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\ApartmentUpdateRequest;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Apartment::select();

        //TODO implement filters

        $apartments = $query->get();

        return response()->json($apartments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentStoreRequest $request)
    {
        $data = $request->all();

        //slug
        $data['slug'] = Str::slug($request->name);

        //todo file image upload
        //todo get lat and long

        $apartment = Apartment::create($data);

        return response()->json($apartment);
    }

    /**
     * Display the specified resource.
     * todo this should be slug
     */
    public function show(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        return response()->json($apartment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentUpdateRequest $request, string $id)
    {
        $apartment = Apartment::findOrFail($id);

        $data = $request->all();

        //TODO handle image upload
        //TODO handle lat and long updates

        $apartment->update($data);

        return response()->json($apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->delete();

        return response(status: 204);
    }
}
