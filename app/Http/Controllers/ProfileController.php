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

class ProfileController extends Controller
{

    private function getAddress($address)
    {
        $addressArray = explode(',', $address);
        if (count($addressArray) == 4) {
            $street = trim($addressArray[0]);
            $barangay = trim($addressArray[1]);
            $city = trim($addressArray[2]);
            $province = trim($addressArray[3]);
        } else {
            $barangay = trim($addressArray[0]);
            $city = trim($addressArray[1]);
            $province = trim($addressArray[2]);
        }


        // Step 1: Find the province by name
        $provinceObj = Province::where('province_name', $province)->first();

        // Check if province exists
        if ($provinceObj) {
            $province_code = $provinceObj->province_code;

            // Step 2: Find the city within that province
            $city_code = City::where('province_code', $province_code)
                ->where('city_name', $city)
                ->value('city_code');

            // Step 3: Find the barangay within that province and city
            $barangay_code = Barangay::where('province_code', $province_code)
                ->where('brgy_name', $barangay)
                ->value('brgy_code');
            // Return the result as an associative array
            return [
                [$barangay_code, $barangay],
                [$city_code, $city],
                [$province_code, $province],
            ];
        } else {
            // Handle the case where the province does not exist
            return null; // or handle it as per your application's requirement
        }
    }

    public function getCities($provinceCode)
    {
        $cities = Cache::remember("cities_{$provinceCode}", 60 * 60, function () use ($provinceCode) {
            return City::where('province_code', $provinceCode)->pluck('city_name', 'city_code')->toArray();
        });

        return response()->json($cities);
    }

    public function getBarangays($cityCode)
    {
        $barangays = Cache::remember("barangays_{$cityCode}", 60 * 60, function () use ($cityCode) {
            return Barangay::where('city_code', $cityCode)->pluck('brgy_name', 'brgy_code')->toArray();
        });

        return response()->json($barangays);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $currentAddress = $user->address;
        $modifiedAddress = $this->getAddress($currentAddress);

        $provinces = Cache::remember('provinces', 60 * 60, function () {
            return Province::pluck('province_name', 'province_code')->toArray();
        });

        $cities = Cache::remember("cities_{$modifiedAddress[2][0]}", 60 * 60, function () use ($modifiedAddress) {
            return City::where('province_code', $modifiedAddress[2][0])->pluck('city_name', 'city_code')->toArray();
        });

        $barangays = Cache::remember("barangays_{$modifiedAddress[1][0]}", 60 * 60, function () use ($modifiedAddress) {
            return Barangay::where('city_code', $modifiedAddress[1][0])->pluck('brgy_name', 'brgy_code')->toArray();
        });

        $street = $request->street;
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

        $barangay = Barangay::where('brgy_code', $request->barangay)->value('brgy_name');
        $city = City::where('city_code', $request->city)->value('city_name');
        $province = Province::where('province_code', $request->province)->value('province_name');
        $street = $request->street;


        $address = $street . ', ' . $barangay . ', ' . $city . ', ' . $province;
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

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
