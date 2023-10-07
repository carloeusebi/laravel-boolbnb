<?php

namespace App\Http\Controllers;

use App\Models\Sponsorship;
use Braintree\Gateway;
use Illuminate\Http\Request;

class BraintreeController extends Controller
{
    public function token(Request $request)
    {
        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        if ($request->input('nonce')) {
            $sponsorship = Sponsorship::find($request->sponsorship);
            $nonceFromTheClient = $request->nonce;

            $result = $gateway->transaction()->sale([
                'amount' => $sponsorship->price,
                'paymentMethodNonce' => $nonceFromTheClient
            ]);


            if ($result->success) {
                //
                return view('success.payment');
            } else {
                //
                return view('errors.payment');
            }
        }


        $token = $gateway->clientToken()->generate();


        return view('admin.braintree', compact('token'));
    }
}
