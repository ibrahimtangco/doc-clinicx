<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\Models\User;
use App\Models\Patient;
use App\Models\Barangay;
use App\Models\Province;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisteredUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $provinces = Province::all();
        return view('auth.register', compact('provinces'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisteredUserRequest $request): RedirectResponse
    {
        $locationDetails = [
            'barangay' => Barangay::where('brgy_code', $request->barangay)->value('brgy_name'),
            'city' => City::where('city_code', $request->city)->value('city_name'),
            'province' => Province::where('province_code', $request->province)->value('province_name')
        ];

        if (in_array(null, $locationDetails, true)) {
            return response()->json(['error' => 'Invalid location details provided.'], 400);
        }

        $street = $request->street;
        $address = $street ? "$street, {$locationDetails['barangay']}, {$locationDetails['city']}, {$locationDetails['province']}" : "{$locationDetails['barangay']}, {$locationDetails['city']}, {$locationDetails['province']}";

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $patient = Patient::create([
            'user_id' => $user->id,
            'telephone' => $request->telephone,
            'birthday' => $request->birthday,
            'age' => $request->age,
            'status' => $request->status
        ]);

        $user->sendEmailVerificationNotification();
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function fetchCity(Request $request)
    {
        $province_code = $request->province_code;

        $cities = json_decode(file_get_contents(config_path('cities.json')), true);
        // $data['cities'] = City::where('province_code', $request->province_code)->get();

        $filteredCities['cities'] = array_filter($cities, function ($city) use ($province_code) {
            return $city['province_code'] === $province_code;
        });


        return response($filteredCities);
    }

    public function fetchBarangay(Request $request)
    {
        $city_code = $request->city_code;

        $barangays = json_decode(file_get_contents(config_path('barangay.json')), true);

        $filteredBarangay['barangay'] = array_filter($barangays, function ($barangay) use ($city_code) {
            return $barangay['city_code'] === $city_code;
        });
        // $data['barangay'] = Barangay::where('city_code', $request->city_code)->get();

        return response()->json($filteredBarangay);
    }
}
