<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CurlController extends Controller
{

    public static function curlCreator(string $url, array $headers)
    {

        $response = Http::withHeaders($headers)
            ->timeout(60)
            ->get($url);

        return $response->throw()->json();


    }


}
