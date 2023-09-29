<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
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
        $apartments = Apartment::orderBy('updated_at', 'DESC')->get();

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apartment = new Apartment();

        return view('admin.apartments.create', compact('apartment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ApartmentStoreRequest $request)
    {
        var_dump($request->all());
        $data =  $request->all();

        $apartment = new Apartment();
        $apartment->fill($data);

        // slug
        $apartment->slug = Str::slug($apartment->name, '-');
        dd($apartment);
        $apartment->save();

        return to_route('admin.apartments.show', $apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        return view('admin.apartments.show', compact('apartment'));
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
