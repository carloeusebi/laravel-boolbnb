<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Apartment::with('services');

        $lat = $request->query('lat');
        $lon = $request->query('lon');
        $maxDistance = $request->query('distance');
        $rooms = $request->query('rooms');
        $bedrooms = $request->query('bedrooms');
        $services = $request->query('selectedServices', []);


        if (!empty($services)) {
            $query->whereHas('services', function ($q) use ($services) {
                $q->whereIn('service_id', $services);
            }, '=', count($services));
        }

        if ($rooms) {
            $query->where('rooms', '>=', $rooms);
        }

        if ($bedrooms) {
            $query->where('bedrooms', '>=', $bedrooms);
        }

        $apartments = $query->get();

        if ($lat && $lon && $maxDistance) {
            $apartments = $apartments->filter(function ($apartment) use ($lat, $lon, $maxDistance) {
                $distance = $this->calculateDistance($lat, $lon, $apartment->lat, $apartment->lon);
                $apartment->distance = $distance;
                return ($distance <= $maxDistance);
            });

            $apartments = $apartments->sortBy('distance');
            $apartments = $apartments->values();
        }

        foreach ($apartments as $apt) {
            /**
             * @var Apartment $apt
             */
            $apt->sponsored = $apt->sponsorshipExpiration;
        }

        return response()->json($apartments);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $apartment = Apartment::with('services')->where('slug', $slug)->first();
        if (empty($apartment)) return response()->json(['errors' => 'Appartamento non trovato'], 404);

        return response()->json($apartment);
    }

    /**
     * Calculates the distance in kilometers given two sets of coordinates
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // radius in kilometers

        // radials
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        $dLat = $lat2Rad - $lat1Rad;
        $dLon = $lon2Rad - $lon1Rad;

        $a = sin($dLat / 2) ** 2 + cos($lat1Rad) * cos($lat2Rad) * sin($dLon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;
        return $distance;
    }
}
