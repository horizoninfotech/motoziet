<?php

namespace App\Providers;

use Laravel\Socialite\Two\GoogleProvider;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CustomGoogleProvider extends GoogleProvider
{
    public function __construct(Request $request, $clientId, $clientSecret, $redirectUrl)
    {
        parent::__construct($request, $clientId, $clientSecret, $redirectUrl);
    }

    protected function getHttpClient()
    {
        return new Client(['verify' => false]);
    }
}
