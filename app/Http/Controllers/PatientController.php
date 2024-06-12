<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Patient;
use App\Models\Barangay;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Services\AddressService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{

    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'min:11', 'max:255'],
            'birthday' => ['required', 'date'],
            'age' => ['required', 'integer'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'street' => ['max:255'],
            'status' => ['required', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

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

        $user = User::where('id', $patient->user_id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $address,
            'email' => $request->email,
        ]);

        $patient = Patient::where('id', $patient->id)->update([
            'telephone' => $request->telephone,
            'birthday' => $request->birthday,
            'age' => $request->age,
            'status' => $request->status
        ]);

        return redirect()->back()->with('message', 'Patient information has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $user = User::where('id', $patient->user_id)->first();
        $user->delete();

        return redirect()->route('patients.index');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string'
        ]);
        $search = $request->search;
        // Perform the search query
        $patients = User::where('userType', 'user')
            ->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('middle_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("CONCAT(first_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("CONCAT(last_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ['%' . $search . '%']);
            })
            ->get();


        $searchDisplay = '';

        foreach ($patients as $patient) {
            $searchDisplay .= '
<tr class="bg-white border-b hover:bg-gray-50">
    <td class="px-6 py-4">' . $patient->first_name . '</td>
    <td class="px-6 py-4">' . $patient->middle_name . '</td>
    <td class="px-6 py-4">' . $patient->last_name . '</td>
    <td class="px-6 py-4">' . $patient->address . '</td>
    <td class="px-6 py-4">' . $patient->email . '</td>
    <td class="px-6 py-4 text-right space-x-2 flex items-center">
        <a class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700"
            href="' . route('patients.edit', ['patient' => $patient->id]) . '">Edit</a>
        <form action="' . route('patients.destroy', ['patient' => $patient->id]) . '" method="post">
            ' . csrf_field() . '
            ' . method_field('DELETE') . '
            <button class="font-medium text-red-600" type="submit" onclick="return confirm(`Are you sure you want to delete ' . $patient->first_name . ' ' . $patient->last_name . '\'s record?`)">Delete</button>
        </form>
    </td>
</tr>';
        }
        return response($searchDisplay);
    }
}
