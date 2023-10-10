<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function logVisit(Request $request)
    {
        $request->validate([
            'apartment_id' => 'required|exists:apartments,id',
            'date' => 'required|date',
            'ip_address' => 'required',
        ]);

        $visit = Visit::create($request->only('date', 'ip_address'));
        $visit->apartment()->attach($request->apartment_id);

        return response(status: 204);
    }
}
