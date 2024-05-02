<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePatientRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = User::paginate(10);

        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.patients.create');
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
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('patients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient = User::where('id', $patient->id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'email' => $request->email,
        ]);
        return redirect()->back()->with('message', 'Patient information has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return back();
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string'
        ]);
        $search = $request->search;
        // Perform the search query
        $patients = User::where('first_name', 'LIKE', '%' . $search . '%')
            ->orWhere('middle_name', 'LIKE', '%' . $search . '%')
            ->orWhere('last_name', 'LIKE', '%' . $search . '%')
            ->orWhere('address', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
            ->orWhereRaw("CONCAT(first_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
            ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $search . '%'])
            ->orWhereRaw("CONCAT(last_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
            ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
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
