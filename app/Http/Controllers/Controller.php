<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

use App\warehouse;
use App\Manager;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getOpenMapsData($warehouseid)
    {
        $client = new Client([
            'base_uri' => 'https://routing.openstreetmap.de/routed-car/route/v1/driving/'
        ]);

        $managerLat = urlencode(Manager::find(1)->latitude);
        $managerLong = urlencode(Manager::find(1)->longitude);

        $warehouseLat = urlencode(warehouse::find($warehouseid)->latitude);
        $warehouseLong = urlencode(warehouse::find($warehouseid)->longitude);

        $openMapsParameters = "$warehouseLat,$warehouseLong;$managerLat,$managerLong";

        try {
            
            $response = $client->request('GET',$openMapsParameters);

            $body = $response->getBody();

            $openMapsDataJson = json_decode($body, true);

            $distance = round($openMapsDataJson['routes'][0]['legs'][0]['distance'] / 1000);
            return $distance;

        } catch (RequestException $e) {
            return ['Invalid Coordinates'];
        }
    }
}
