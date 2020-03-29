<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class RajaOngkirController extends Controller
{
    public function getProvince()
    {
        $client = new Client();
        $result = $client->request(
            "GET",
            "https://api.rajaongkir.com/starter/province",
            [
                'headers' => [
                    'key'    => env('RAJAONGKIR_KEY'),
                    'accept' => 'application/json',
                ]
            ]
        );

        return json_decode($result->getBody(), true)['rajaongkir']['results'];
    }

    public function getCity(Request $request)
    {
        $client = new Client();
        $result = $client->request(
            "GET",
            "https://api.rajaongkir.com/starter/city?province={$request->province_id}",
            [
                'headers' => [
                    'key'    => env('RAJAONGKIR_KEY'),
                    'accept' => 'application/json',
                ]
            ]
        );

        return json_decode($result->getBody(), true)['rajaongkir']['results'];
    }

    public function getCost($destination, $weight, $courier)
    {
        $client = new Client();
        $result = $client->request(
            "POST",
            "https://api.rajaongkir.com/starter/cost",
            [
                'headers' => [
                    'key'    => env('RAJAONGKIR_KEY'),
                    'accept' => 'application/json',
                ],
                'form_params' => [
                    'origin'      => env('SHOP_CITY_ID'),
                    'destination' => $destination,
                    'weight'      => $weight,
                    'courier'     => $courier
                ],
            ]
        );

        return json_decode($result->getBody(), true)['rajaongkir'];
    }
}
