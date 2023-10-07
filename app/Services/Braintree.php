<?php

namespace App\Services;

use Braintree\Gateway;
use Illuminate\Support\Facades\Auth;

class Braintree
{
    private Gateway $gateway;


    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    }

    public function gateway(): Gateway
    {
        return $this->gateway;
    }

    public function generateToken()
    {
        return $this->gateway->clientToken()->generate();
    }
}
