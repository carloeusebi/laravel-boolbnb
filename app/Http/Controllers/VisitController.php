<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function logVisit(Request $request, string $id)
    {
        Visit::create([
            'ip_address' => $request->ip(),
            'date' => now(),
            'apartment_id' => $id
        ]);

        return response(status: 204);
    }
}
