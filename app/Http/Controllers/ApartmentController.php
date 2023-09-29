<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\ApartmentUpdateRequest;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $data =  $request->all();

        $apartment = new Apartment();

        $thumbnail = $request->file('thumbnail');
        $data['thumbnail'] = $this->saveImage($thumbnail);

        $apartment->fill($data);

        // Assign the user ID to the apartment
        $apartment->user_id = Auth::user()->id;

        // Create slug from apartment's name
        $apartment->slug = Str::slug($apartment->name, '-');
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
    public function edit(Apartment $apartment)
    {
        return view('admin.apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentUpdateRequest $request, Apartment $apartment)
    {
        $data = $request->all();

        // Assign the user ID to the apartment
        $apartment->user_id = Auth::user()->id;

        // IMAGE UPLOAD
        $thumbnail = $request->file('thumbnail');
        if ($thumbnail) {

            // if there was an old thumbnail delete it
            if ($apartment->thumbnail) {
                Storage::delete($apartment->thumbnail);
            }

            $data['thumbnail'] = $this->saveImage($thumbnail);
        }

        // Create slug from apartment's name
        $apartment->slug = Str::slug($apartment->name, '-');
        $apartment->update($data);

        return to_route('admin/apartments/show', $apartment);
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

    /**
     * Saves the image in the public folder `images`
     * 
     * @return string The pat of the saved image.
     */
    private function saveImage($image)
    {
        return Storage::put('images', $image);
    }
}
