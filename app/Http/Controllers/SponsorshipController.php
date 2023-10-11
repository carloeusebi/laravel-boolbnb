<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Services\Braintree;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    public function index(Apartment $apartment)
    {
        $sponsorships = Sponsorship::all();

        $braintree = new Braintree();
        $token = $braintree->generateToken([]);

        return view('admin.apartments.sponsor', compact('apartment', 'sponsorships', 'token'));
    }


    private function createSponsorship(Apartment $apartment, Sponsorship $sponsorship)
    {
        // get the last sponsorship
        $currentSponsorship = $apartment->sponsorships->first();

        $initialDate = $currentSponsorship
            ? Carbon::parse($currentSponsorship->pivot->expiration_date)
            : Carbon::now();

        $expirationDate = $initialDate->addMilliseconds($sponsorship->duration);
        $attributes = ['expiration_date' => $expirationDate];
        $apartment->sponsorships()->attach($sponsorship->id, $attributes);
    }


    public function processPayment(Request $request, Apartment $apartment)
    {
        $request->validate([
            'sponsorship_id' => 'required|exists:sponsorships,id',
            'nonce' => 'required',
        ]);

        $sponsorship = Sponsorship::find($request->sponsorship_id);
        $nonceFromTheClient = $request->nonce;

        $braintree = new Braintree();
        $gateway = $braintree->gateway();

        $result = $gateway->transaction()->sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $nonceFromTheClient,
        ]);

        if ($result->success) {
            $this->createSponsorship($apartment, $sponsorship);
            return to_route('admin.apartments.show', compact('apartment'))
                ->with('type', 'success')
                ->with('message', "Sponsorizzazione avvenuta con successo");
        } else {
            return to_route('admin.sponsorship', $apartment)->withErrors(['error' => 'Qualcosa è andato storto']);
        }
    }
}
