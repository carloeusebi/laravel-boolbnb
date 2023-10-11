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
            'environment' => 'sandbox',
            'merchantId' => '55prmmtwbp2n82p2',
            'publicKey' => '43tcx4ccbv388mfh',
            'privateKey' => 'e4ad170159907e8995d70279102970e1'
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
