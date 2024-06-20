<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Provider;

class SuperAdminController extends Controller
{
    public function index()
    {
        // dd(auth()->user()->id);
        $provider = Provider::where('user_id', auth()->user()->id)->firstOrFail();

        return view('super_admin.index', compact('provider'));
    }
}
