<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Barangay;
use App\Models\Province;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Services\AddressService;

class ProfileController extends Controller
{
    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }

    public function getCities($provinceCode)
    {
        $cities = json_decode(file_get_contents(config_path('cities.json')), true);
        $filteredCities['cities'] = array_filter($cities, function ($city) use ($provinceCode) {
            return $city['province_code'] === $provinceCode;
        });


        return response()->json($filteredCities);
    }

    public function getBarangays($cityCode)
    {
        $barangays = json_decode(file_get_contents(config_path('barangay.json')), true);

        $filteredBarangay['barangays'] = array_filter($barangays, function ($barangay) use ($cityCode) {
            return $barangay['city_code'] === $cityCode;
        });

        return response()->json($filteredBarangay);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $currentAddress = $user->address;
        $modifiedAddress = $this->addressService->getAddress($currentAddress);

        $provinces = json_decode(file_get_contents(config_path('province.json')), true);

        $rawCities = json_decode(file_get_contents(config_path('cities.json')), true);
        $cities = array_filter($rawCities, function ($city) use ($modifiedAddress) {
            return $city['province_code'] === $modifiedAddress['province_code'];
        });

        $rawBarangays = json_decode(file_get_contents(config_path('barangay.json')), true);
        $barangays = array_filter($rawBarangays, function ($barangay) use ($modifiedAddress) {
            return $barangay['city_code'] ===  $modifiedAddress['city_code'];
        });

        // $street = $request->street;
        $userType = $request->user()->userType;

        $view = match ($userType) {
            'admin' => 'admin.admin_layouts.profile',
            'SuperAdmin' => 'super_admin.super_admin_layouts.profile',
            default => 'profile.edit',
        };

        return view($view, compact('user', 'provinces', 'cities', 'barangays', 'modifiedAddress'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $rawBarangays = json_decode(file_get_contents(config_path('barangay.json')), true);
        $barangay = array_filter($rawBarangays, function ($barangay) use ($request) {
            return $barangay['brgy_code'] ===  $request->barangay;
        });
        $barangay = reset($barangay); // Get the first (and only) barangay if it exists

        $rawCities = json_decode(file_get_contents(config_path('cities.json')), true);
        $city = array_filter($rawCities, function ($city) use ($request) {
            return $city['city_code'] === $request->city;
        });
        $city = reset($city); // Get the first (and only) city if it exists

        $rawProvinces = json_decode(file_get_contents(config_path('province.json')), true);
        $province = array_filter($rawProvinces, function ($province) use ($request) {
            return $province['province_code'] === $request->province;
        });
        $province = reset($province); // Get the first (and only) province if it exists

        $street = $request->street;

        if ($street) {
            $address = $street . ', ' . $barangay['brgy_name'] . ', ' . $city['city_name'] . ', ' . $province['province_name'];
        } else {
            $address = $barangay['brgy_name'] . ', ' . $city['city_name'] . ', ' . $province['province_name'];
        }

        $request->user()->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $address,
            'email' => $request->email,
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $user = $request->user()->save();

        if (!$user) {
            emotify('error', 'Failed to update profile');
            return redirect()->route('profile.edit');
        }
        emotify('success', 'Profile updated successfully');
        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
