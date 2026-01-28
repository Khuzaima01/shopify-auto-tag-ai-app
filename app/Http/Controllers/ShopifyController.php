<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Shopify;

class ShopifyController extends Controller
{
    public function install(Request $request)
    {
        $shop = $request->shop;
        $apiKey = config('services.shopify.key');
        $scopes = config('services.shopify.scopes');
        $redirectUri = config('services.shopify.redirect_uri');

        $url = "https://{$shop}/admin/oauth/authorize" .
            "?client_id={$apiKey}" .
            "&scope={$scopes}" .
            "&redirect_uri={$redirectUri}";

        return redirect($url);
    }

    public function callback(Request $request)
    {
        $shop = $request->shop;
        $code = $request->code;

        $response = Http::asForm()->post("https://{$shop}/admin/oauth/access_token", [
            'client_id' => config('services.shopify.key'),
            'client_secret' => config('services.shopify.secret'),
            'code' => $code,
        ]);

        $accessToken = $response['access_token'];

        // TODO: Save $shop + $accessToken in DB

        return redirect('/home');
    }
}
