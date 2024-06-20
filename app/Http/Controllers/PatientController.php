<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Patient;
use App\Models\Barangay;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Services\AddressService;
use App\Services\PatientService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{

    protected $addressService, $patientModel, $userModel, $patientService;

    public function __construct(AddressService $addressService, PatientService $patientService)
    {
        $this->addressService = $addressService;
        $this->patientService = $patientService;
        $this->patientModel = new Patient();
        $this->userModel = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::paginate(10);

        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = Province::all();
        return view('admin.patients.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PatientStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $barangay = Barangay::where('brgy_code', $request->barangay)->value('brgy_name');
        $city = City::where('city_code', $request->city)->value('city_name');
        $province = Province::where(
            'province_code',
            $request->province
        )->value('province_name');
        $street = $request->street;

        if ($street) {
            $address = $street . ', ' . $barangay . ', ' . $city . ', ' . $province;
        } else {
            $address = $barangay . ', ' . $city . ', ' . $province;
        }

        DB::transaction(function () use ($validated, $address) {
            $user = $this->userModel->storeUserDetails($validated, $address);
            $this->patientModel->storePatientDetails($user->id, $validated);
        });
        emotify('success', 'Patient created successfully');
        return redirect()->route('patients.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $user = $patient;
        $currentAddress = $patient->user->address;
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

        return view('admin.patients.edit', compact('user', 'provinces', 'cities', 'barangays', 'modifiedAddress'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {

        $validated = $request->validated();

        $barangay = Barangay::where('brgy_code', $request->barangay)->value('brgy_name');
        $city = City::where('city_code', $request->city)->value('city_name');
        $province = Province::where(
            'province_code',
            $request->province
        )->value('province_name');
        $street = $request->street;

        if ($street) {
            $address = $street . ', ' . $barangay . ', ' . $city . ', ' . $province;
        } else {
            $address = $barangay . ', ' . $city . ', ' . $province;
        }

        DB::transaction(function () use ($validated, $address, $patient) {
            $this->userModel->updateUserDetails($validated, $address, $patient->user_id);
            $this->patientModel->updatePatientDetails($validated, $patient->id);
        });
        emotify('success', 'Patiend information has been updated');
        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $user = User::where('id', $patient->user_id)->first();
        $result = $user->delete();

        if (!$result) {
            emotify('errpr', 'Failed to delete patient');
            return redirect()->route('patients.index');
        }
        emotify('success', 'Patient deleted successfully');
        return redirect()->route('patients.index');
    }

    public function search(Request $request)
    {
        $patients = $this->patientModel->searchPatient($request->search);
        $searchDisplay = $this->patientService->searchResults($patients);

        return response($searchDisplay);
    }
}
