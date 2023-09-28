<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
     * Display a listing of the deleted resource.
     */
    public function trash()
    {
        $apartments = Apartment::onlyTrashed()->get();
        return view('admin.apartments.trash', compact('apartments'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return to_route('home');
    }

    public function drop(string $id)
    {
        $apartment = Apartment::onlyTrashed()->findOrFail($id);
        $apartment->forceDelete();
        return to_route('admin.apartments.trash');
    }

    public function restore(string $id)
    {
        $apartment = Apartment::onlyTrashed()->findOrFail($id);
        $apartment->restore();
        return to_route('admin.apartments.trash');
    }

    public function dropAll()
    {
        Apartment::onlyTrashed()->forceDelete();
        return to_route('admin.apartments.trash');
    }

    public function restoreAll()
    {
        Apartment::onlyTrashed()->restore();
        return to_route('admin.apartments.trash');
    }
}
