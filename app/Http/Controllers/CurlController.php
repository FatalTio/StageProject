<?php

namespace App\Http\Controllers;

class CurlController extends Controller
{

    public static function curlCreator(string $url, array $headers)
    {

        $request = "{$url}";
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,     
            CURLOPT_HTTPHEADER => $headers,    
            CURLOPT_RETURNTRANSFER => 1   
        ));
    
        $response = curl_exec($curl);

        return json_decode($response, true);

    }


}