<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Sponsorship;
use App\Services\Braintree;
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
            dd('success');
            //create relation
        } else {
            dd('error');
        }
    }
}