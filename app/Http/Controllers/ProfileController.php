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
        $modifiedAddress = $this->addressService->getAddress($currentAddress);

        $provinces = Cache::remember('provinces', 60 * 60, function () {
            return Province::pluck('province_name', 'province_code')->toArray();
        });

        $cities = Cache::remember("cities_{$modifiedAddress['province_code']}", 60 * 60, function () use ($modifiedAddress) {
            return City::where('province_code', $modifiedAddress['province_code'])->pluck('city_name', 'city_code')->toArray();
        });

        $barangays = Cache::remember("barangays_{$modifiedAddress['city_code']}", 60 * 60, function () use ($modifiedAddress) {
            return Barangay::where('city_code', $modifiedAddress['city_code'])->pluck('brgy_name', 'brgy_code')->toArray();
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

        $barangay = Barangay::where('brgy_code', $request->barangay)->value('brgy_name');
        $city = City::where('city_code', $request->city)->value('city_name');
        $province = Province::where('province_code', $request->province)->value('province_name');
        $street = $request->street;

        if ($street) {
            $address = $street . ', ' . $barangay . ', ' . $city . ', ' . $province;
        } else {
            $address = $barangay . ', ' . $city . ', ' . $province;
        }
        // dd($request->all());
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
