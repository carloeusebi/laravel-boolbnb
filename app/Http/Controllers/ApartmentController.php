<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\ApartmentUpdateRequest;
use App\Models\Apartment;
use Illuminate\Support\Facades\Storage;
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
        $data = $request->validated();

        $thumbnail = $request->file('thumbnail');
        if ($thumbnail)
            $data['thumbnail'] = $this->saveImage($thumbnail);

        //slug
        $data['slug'] = Str::slug($request->name);

        $apartment = Apartment::create($data);

        return response()->json($apartment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $apartment = Apartment::where('slug', $slug)->first();
        if (empty($apartment)) return response()->json(['errors' => 'Appartamento non trovato'], 404);

        return response()->json($apartment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ApartmentUpdateRequest $request, string $id)
    {
        $apartment = Apartment::findOrFail($id);

        $data = $request->all();

        // IMAGE UPLOAD
        $thumbnail = $request->file('thumbnail');
        if ($thumbnail) {

            // if there was an old thumbnail delete it
            if ($apartment->thumbnail) {
                Storage::delete($apartment->thumbnail);
            }

            $data['thumbnail'] = $this->saveImage($thumbnail);
        }
        $data['slug'] = Str::slug($request->name);

        $apartment->update($data);

        return response()->json($apartment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apartment = Apartment::findOrFail($id);

        //deletes the thumbnail
        if ($apartment->thumbnail)
            Storage::delete($apartment->thumbnail);

        $apartment->delete();

        return response(status: 204);
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
