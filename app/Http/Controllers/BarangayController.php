<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    public function index()
    {
        $jsonData = file_get_contents(config_path('barangay.json'));

        $data = json_decode($jsonData, true);

        foreach ($data as $item) {
            Barangay::create($item);
        }
    }
}
