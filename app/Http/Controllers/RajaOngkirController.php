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
            "https://api.rajaongkir.com/starter/city?province={$request->provinceId}",
            [
                'headers' => [
                    'key'    => env('RAJAONGKIR_KEY'),
                    'accept' => 'application/json',
                ]
            ]
        );

        return json_decode($result->getBody(), true)['rajaongkir']['results'];
    }

    public function getCost(Request $request)
    {
        $couriers = config('app.couriers');
        $client = new Client();

        $models = [];
        foreach ($couriers as $value) {

            $model = $client->request(
                "POST",
                "https://api.rajaongkir.com/starter/cost",
                [
                    'headers' => [
                        'key'    => env('RAJAONGKIR_KEY'),
                        'accept' => 'application/json',
                    ],
                    'form_params' => [
                        'origin'      => env('SHOP_CITY_ID'),
                        'destination' => $request->destination,
                        'weight'      => 1000, //$request->weight,
                        'courier'     => $value,
                    ],
                ]
            );
            array_push($models, json_decode($model->getBody(), true)['rajaongkir']['results'][0]);
        }

        $results = [];
        foreach ($models as $model) {
            foreach ($model['costs'] as $cost) {
                $results[] = [
                    'code'    => strtoupper($model['code']),
                    'service' => $cost['service'],
                    'cost'    => rupiah_format($cost['cost'][0]['value']),
                    'etd'     => $cost['cost'][0]['etd'],
                ];
            }
        }

        return $results;
    }
}
