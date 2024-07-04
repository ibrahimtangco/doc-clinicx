<?php

namespace App\Services;

class AddressService
{
    public function getAddress($address)
    {
        $addressArray = explode(',', $address);

        // Initialize variables
        $street = '';
        $barangayName = '';
        $cityName = '';
        $provinceName = '';

        // Determine array values based on count
        if (count($addressArray) == 4) {
            $street = trim($addressArray[0]);
            $barangayName = trim($addressArray[1]);
            $cityName = trim($addressArray[2]);
            $provinceName = trim($addressArray[3]);
        } elseif (count($addressArray) == 3) {
            $barangayName = trim($addressArray[0]);
            $cityName = trim($addressArray[1]);
            $provinceName = trim($addressArray[2]);
        } else {
            // Handle cases where address format doesn't match expected patterns
            return null;
        }

        // Fetch province object
        $rawProvinces = json_decode(file_get_contents(config_path('province.json')), true);
        $provinceObj = array_filter($rawProvinces, function ($province) use ($provinceName) {
            return $province['province_name'] === $provinceName;
        });

        // Check if province exists
        if (empty($provinceObj)) {
            return null; // Province not found, handle accordingly
        }

        // Get the first province object (assuming there should only be one match)
        $provinceObj = reset($provinceObj);

        // Filter cities based on province code and city name
        $rawCities = json_decode(file_get_contents(config_path('cities.json')), true);
        $filteredCities = array_filter($rawCities, function ($city) use ($provinceObj, $cityName) {
            return $city['province_code'] === $provinceObj['province_code'] && $city['city_name'] === $cityName;
        });

        // Check if city exists
        if (empty($filteredCities)) {
            return null; // City not found, handle accordingly
        }

        // Get the first city object (assuming there should only be one match)
        $cityObj = reset($filteredCities);

        // Filter barangays based on city code and barangay name
        $rawBarangays = json_decode(file_get_contents(config_path('barangay.json')), true);
        $filteredBarangays = array_filter($rawBarangays, function ($barangay) use ($cityObj, $barangayName) {
            return $barangay['city_code'] === $cityObj['city_code'] && $barangay['brgy_name'] === $barangayName;
        });

        // Check if barangay exists
        if (empty($filteredBarangays)) {
            return null; // Barangay not found, handle accordingly
        }

        // Get the first barangay object (assuming there should only be one match)
        $barangayObj = reset($filteredBarangays);

        // Return address data
        return [
            'street_name' => $street,
            'brgy_code' => $barangayObj['brgy_code'],
            'brgy_name' => $barangayObj['brgy_name'],
            'city_code' => $cityObj['city_code'],
            'city_name' => $cityObj['city_name'],
            'province_code' => $provinceObj['province_code'],
            'province_name' => $provinceObj['province_name']
        ];
    }
}
