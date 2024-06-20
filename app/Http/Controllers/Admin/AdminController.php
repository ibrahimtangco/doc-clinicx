<?php

namespace App\Http\Controllers\Admin;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalAppointments = Appointment::where('status', 'booked')->count();
        return view('admin.dashboard', [
            'totalPatients' => $totalPatients,
            'totalAppointments' => $totalAppointments
        ]);
    }
}
