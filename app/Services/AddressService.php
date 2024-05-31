<?php

namespace App\Services;

use App\Models\City;
use App\Models\Barangay;
use App\Models\Province;

class AddressService
{
    public function getAddress($address)
    {
        $addressArray = explode(',', $address);
        if (count($addressArray) == 4) {
            $street = trim($addressArray[0]);
            $barangay = trim($addressArray[1]);
            $city = trim($addressArray[2]);
            $province = trim($addressArray[3]);
        } else {
            $street = '';
            $barangay = trim($addressArray[0]);
            $city = trim($addressArray[1]);
            $province = trim($addressArray[2]);
        }

        $provinceObj = Province::where('province_name', $province)->first();

        if ($provinceObj) {
            $province_code = $provinceObj->province_code;

            $city_code = City::where('province_code', $province_code)
                ->where('city_name', $city)
                ->value('city_code');

            // Step 3: Find the barangay within that province and city
            $barangay_code = Barangay::where('province_code', $province_code)
                ->where('brgy_name', $barangay)
                ->value('brgy_code');
            // Return the result as an associative array
            return [
                'street_name' => $street,
                'brgy_code' => $barangay_code,
                'brgy_name' => $barangay,
                'city_code' => $city_code,
                'city_name' => $city,
                'province_code' => $province_code,
                'province_name' => $province
            ];
        } else {
            // Handle the case where the province does not exist
            return null; // or handle it as per your application's requirement
        }
    }
}
