<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Barangay;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function populateDataBase()
    {
        $jsonBrgy = file_get_contents(config_path('barangay.json'));
        $jsonCities = file_get_contents(config_path('cities.json'));
        $jsonProvinces = file_get_contents(config_path('province.json'));

        $dataBrgy = json_decode($jsonBrgy, true);
        $dataCities = json_decode($jsonCities, true);
        $dataProvinces = json_decode($jsonProvinces, true);

        DB::transaction(function () use ($dataBrgy, $dataCities, $dataProvinces) {
            foreach ($dataBrgy as $item) {
                Barangay::create($item);
            }
            foreach ($dataCities as $item) {
                City::create($item);
            }
            foreach ($dataProvinces as $item) {
                Province::create($item);
            }
        });
    }
}
