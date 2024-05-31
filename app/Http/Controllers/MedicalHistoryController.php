<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalHistoryController extends Controller
{
    public function show(Patient $patient)
    {
        $medical_history = MedicalHistory::where('patient_id', $patient->id)->get();

        return view('admin.patients.show', compact('patient', 'medical_history'));
    }
}
