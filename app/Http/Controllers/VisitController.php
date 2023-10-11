<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function logVisit(Request $request, string $id)
    {
        $ipAddress = $request->ip();
        $apartment = Apartment::find($id);
        $lastVisit = $apartment->visits->where('ip_address', $ipAddress)->sortBy('created_at')->last();

        // check that same ip address didn't make two visits in the same minute
        if ($lastVisit) {
            $lastVisitTimestamp = Carbon::parse($lastVisit->created_at);
            $now = Carbon::now();
            $oneMinute = 1;
        }

        if (!$lastVisit || $now->diffInMinutes($lastVisitTimestamp) > $oneMinute) {
            Visit::create([
                'ip_address' => $ipAddress,
                'date' => now(),
                'apartment_id' => $id
            ]);

            return response(status: 201);
        }

        return response(status: 204);
    }
}
