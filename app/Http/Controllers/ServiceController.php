<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{

    public function display()
    {
        $services = Service::where('availability', 1)->get();
        // dd($services);
        return view('user/dashboard', ['services' => $services]);
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

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|string'
        ]);

        $search = $request->search;

        // Perform the search query
        $services = Service::where('name', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->orWhere('duration', 'LIKE', '%' . $search . '%')
            ->orWhere('price', 'LIKE', '%' . $search . '%')
            ->get();

        $searchDisplay = '';

        foreach ($services as $service) {
            $searchDisplay .= '
            <tr class="bg-white border-b hover:bg-gray-50">
                <td class="px-6 py-4">' . htmlspecialchars($service->name) . '</td>
                <td class="px-6 py-4">&#8369;' . number_format($service->price, 0, ".", ",") . '</td>
                <td class="px-6 py-4">' . htmlspecialchars($service->description) . '</td>
                <td class="px-6 py-4 text-center ">
                    ' . ($service->availability ? '<span class="text-green-500 text-sm">Available</span>' : '<span class="text-yellow-500 text-sm">Not Available</span>') . '
                </td>
                <td class="px-6 py-4 text-right space-x-2 flex items-center">
                    <a class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700" href="' . route('services.edit', ['service' => $service->id]) . '">Edit</a>
                    <form action="' . route('services.destroy', ['service' => $service->id]) . '" method="post" onsubmit="return confirm(\'Are you sure you want to delete ' . htmlspecialchars($service->name) . ' service?\')">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button class="font-medium text-red-600" type="submit">Delete</button>
                    </form>
                </td>
            </tr>';
        }

        return response($searchDisplay);
    }
}
