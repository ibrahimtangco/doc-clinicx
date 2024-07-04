<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{

    protected $serviceModel;

    function __construct(Service $serviceModel)
    {
        $this->serviceModel = $serviceModel;
    }

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
        $validated = $request->validated();
        $service = $this->serviceModel->storeServicedetails($validated);

        if (!$service) {
            emotify('error', 'Failed to add service');
            return redirect()->route('services.index');
        }

        emotify('success', 'Service added successfully');
        return redirect()->route('services.index');
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
        $validated = $request->validated();

        $service = $this->serviceModel->updateServiceDetails($validated, $service->id);

        if (!$service) {
            emotify('error', 'Failed to update service');
            return redirect()->route('services.index');
        }

        emotify('success', 'Service information has been updated');
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service = $this->serviceModel->deleteService($service);

        if (!$service) {
            emotify('error', 'Failed to delete service');
            return redirect()->route('services.index');
        }

        emotify('success', 'Service has been deleted');
        return redirect()->route('services.index');
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
                <td class="px-6 py-4">Php' . number_format($service->price, 0, ".", ",") . '</td>
                <td class="px-6 py-4">' . htmlspecialchars($service->description) . '</td>
                <td class="px-6 py-4 text-center ">
                    ' . ($service->availability ? '<span class="text-green-500 text-sm">Available</span>' : '<span class="text-yellow-500 text-sm">Not Available</span>') . '
                </td>
                <td class="px-6 py-4 text-right space-x-2 flex items-center">
                    <a class="font-medium text-white bg-blue-600 px-2 py-1 rounded hover:bg-blue-700 flex items-center justify-center gap-1 w-fit" href="' . route('services.edit', ['service' => $service->id]) . '"><svg fill="none" height="15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												stroke="currentColor" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg">
												<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
												<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
											</svg>
											<span class="hidden md:block">Edit</span></a>
                    <form action="' . route('services.destroy', ['service' => $service->id]) . '" method="post" onsubmit="return confirm(\'Are you sure you want to delete ' . htmlspecialchars($service->name) . ' service?\')">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button class="font-medium text-white bg-red-600 px-2 py-1 rounded hover:bg-red-700 flex items-center justify-center gap-1 w-fit" type="submit"><svg fill="none" height="15" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													stroke="currentColor" viewBox="0 0 24 24" width="15" xmlns="http://www.w3.org/2000/svg">
													<path d="M3 6h18"></path>
													<path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
												</svg><span class="hidden md:block">Delete</span></button>
                    </form>
                </td>
            </tr>';
        }

        return response($searchDisplay);
    }
}
