<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


use App\warehouse;
use App\Manager;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getOpenMapsData($warehouseid)
    {
        $managerLat = urlencode(Manager::find(1)->latitude);
        $managerLong = urlencode(Manager::find(1)->longitude);

        $warehouseLat = urlencode(warehouse::find($warehouseid)->latitude);
        $warehouseLong = urlencode(warehouse::find($warehouseid)->longitude);

        $openMapsUrl = "https://routing.openstreetmap.de/routed-car/route/v1/driving/$warehouseLat,$warehouseLong;$managerLat,$managerLong";

        $openMapsData = file_get_contents($openMapsUrl);
        $openMapsDataJson = json_decode($openMapsData, true);

        $distance = round($openMapsDataJson['routes'][0]['legs'][0]['distance'] / 1000);

        return $distance;
    }
}
