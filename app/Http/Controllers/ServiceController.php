<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{

    public function display()
    {
        $services = Service::all();
        // dd($services);
        return view('dashboard', ['services' => $services]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        // dd($services);
        return view('admin.services.index', ['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'price' => $request->price,
            'availability' => $request->availability == true ? 1 : 0
        ]);

        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', ['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {

        Service::where('id', $service->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'duration' => $request->duration,
            'price' => $request->price,
            'availability' => $request->availability == true ? 1 : 0
        ]);

        return redirect()->back()->with('message', 'Service information has been update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->back()->with('message', 'A service has been deleted.');
    }
}
