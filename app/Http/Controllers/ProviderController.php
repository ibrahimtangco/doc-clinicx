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
            'avatar' => $path . $filename,
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
}
