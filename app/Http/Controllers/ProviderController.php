<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = Provider::all();
        // dd($providers);
        return  view('admin.providers.index', ['providers' => $providers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.providers.create');
    }

    /**
     * Store a newly created resource in storage. StoreProviderRequest
     */
    public function store(StoreProviderRequest $request)
    {
        if ($request->has('avatar')) {
            $file = $request->file('avatar');
            $extention  = $file->getClientOriginalExtension();

            $filename = time() . '.' . $extention;
            $path = 'images/uploads/avatar/';
            $file->move($path, $filename);
        } else {
            $path = 'images/';
            $filename = 'profile_placeholder.png';
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'email' => $request->email,
            'userType' => $request->userType,
            'password' => Hash::make($request->password)
        ]);

        Provider::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'specialization' => $request->specialization
        ]);

        return redirect()->route('providers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        return view('admin.providers.show', ['provider' => $provider]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {

        return view('admin.providers.edit', ['provider' => $provider]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProviderRequest $request, Provider $provider)
    {

        $user = User::where('id', $provider->user->id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'email' => $request->email,
            'userType' => $request->userType,
            'password' => Hash::make($request->password)
        ]);

        Provider::where('id', $provider->id)->update([
            'title' => $request->title,
            'specialization' => $request->specialization
        ]);

        return redirect()->back()->with('message', 'Providers information has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {

        $provider = Provider::findOrFail($provider->id);
        $user = User::findOrFail($provider->user->id);
        $provider->delete();
        $user->delete();

        return redirect()->route('providers.index')->with('message', 'Providers data has been deleted.');
    }

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string'
        ]);
        $search = $request->search;
        // Perform the search query
        $providers = Provider::whereHas('user', function ($query) use ($search) {
            $query->where(function ($subquery) use ($search) {
                $subquery->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('title', 'LIKE', str_replace('.', '', '%' . $search . '%')); // Remove dot for matching
            })
                ->orWhere('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('middle_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(first_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(last_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(first_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(last_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(middle_name, ' ', first_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(middle_name, ' ', last_name, ' ', first_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(middle_name, ' ', first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(last_name, ' ', middle_name, ' ', first_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(title, ' ', first_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(title, ' ', first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(title, ' ', first_name, ' ', last_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(title, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(title, ' ', last_name, ' ', first_name) LIKE ?", ['%' . $search . '%'])
                ->orWhereRaw("CONCAT(title, ' ', first_name, ' ', middle_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        })
            ->orWhere('specialization', 'LIKE', '%' . $search . '%')
            ->get();




        $searchDisplay = '';

        foreach ($providers as $provider) {
            $searchDisplay .= '
    <tr class="bg-white border-b hover:bg-gray-50">
        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap" scope="row">
            <a href="' . route('providers.show', ['provider' => $provider->id]) . '">
                ' . $provider->title . '
                ' . $provider->user->first_name . '
                ' . ($provider->user->middle_name ? strtoupper(substr($provider->user->middle_name, 0, 1)) . '. ' : '') . '
                ' . $provider->user->last_name . '
            </a>
        </td>
        <td class="px-6 py-4">' . $provider->specialization . '</td>
        <td class="px-6 py-4">' . $provider->user->email . '</td>
        <td class="px-6 py-4 text-right space-x-2 flex items-center">
            <a class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700"
                href="' . route('providers.edit', ['provider' => $provider->id]) . '">Edit</a>
            <form action="' . route('providers.destroy', ['provider' => $provider->id]) . '" method="post">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button class="font-medium text-red-600" type="submit" onclick="return confirm(\'Are you sure you want to delete ' . $provider->user->first_name . ' ' . $provider->user->last_name . '\\\'s record?\')">Delete</button>
            </form>
        </td>
    </tr>';
        }

        return response($searchDisplay);
    }
}
