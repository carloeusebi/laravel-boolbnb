<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApartmentStoreRequest;
use App\Http\Requests\ApartmentUpdateRequest;
use App\Models\Apartment;
use Exception;
use Illuminate\Support\Facades\Http;
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
        $data = $request->all();

        //slug
        $data['slug'] = Str::slug($request->name);

        // IMAGE UPLOAD
        if (array_key_exists('thumbnail', $data)) {
            $data['thumbnail'] = $this->saveImage($data['thumbnail']);
        }

        // COORDINATES
        try {
            $coordinates = $this->getCoordinates($request->address);
        } catch (Exception $e) {
            $code = $e->getCode() === 422 ? 422 : 500;
            return response()->json(['errors' => $e->getMessage()], $code);
        }
        $data['lat'] = $coordinates['lat'];
        $data['lon'] = $coordinates['lon'];

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
        if (array_key_exists('thumbnail', $data)) {
            // if there was a previous thumbnail, delete the old thumbnail
            if ($apartment->thumbnail)
                Storage::delete($apartment->thumbnail);

            $data['thumbnail'] = $this->saveImage($data['thumbnail']);
        }

        // COORDINATES
        if ($apartment->address !== $request->address) {
            try {
                $coordinates = $this->getCoordinates($request->address);
            } catch (Exception $e) {
                $code = $e->getCode() === 422 ? 422 : 500;
                return response()->json(['errors' => $e->getMessage()], $code);
            }
            $data['lat'] = $coordinates['lat'];
            $data['lon'] = $coordinates['lon'];
        }

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

        $apartment->destroy();

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


    /**
     * Makes an api call to the 
     * 
     * @param string $address The Address string.
     * @return array An array containing the coordinate's keys `lan` and `lon`
     */
    private function getCoordinates(string $address)
    {
        $api_key = env('TOM_TOM_KEY');

        $response = Http::withUrlParameters([
            'endpoint' => 'https://api.tomtom.com/search/2/geocode',
            'address' => "$address.json",
            'key' => $api_key,
        ])->get('{+endpoint}/{address}?key={key}');

        $response->throw();

        if ($response['summary']['totalResults'] === 0)
            throw new \Exception('Indirizzo non valido.', 422);

        $coordinates = $response['results'][0]['position'];
        return $coordinates;
    }
}
