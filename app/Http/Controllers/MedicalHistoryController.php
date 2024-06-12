<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicalHistoryRequest;
use App\Http\Requests\MedicalHistoryRequest;
use App\Http\Requests\UpdateMedicalHistoryRequest;
use App\Models\MedicalHistory;
use App\Models\Patient;
use Exception;

class MedicalHistoryController extends Controller
{
    protected $medicalHistoryModel;

    function __construct()
    {
        $this->medicalHistoryModel = new MedicalHistory();
    }

    public function show(Patient $patient)
    {
        $medicalHistories = $this->medicalHistoryModel->showUserMedicalHistory($patient);
        return view('admin.patients.show', compact('patient', 'medicalHistories'));
    }

    public function store(CreateMedicalHistoryRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $result = $this->medicalHistoryModel->storeMedicalHistory($validatedData);

            if ($result) {
                return redirect()->route('show.patient.record', $validatedData['patient_id'])->with('message', 'Medical history added successfully');
            } else {
                return redirect()->route('show.patient.record', $validatedData['patient_id'])->with('error', 'Failed to add medical history');
            }
        } catch (Exception $e) {
            // Log the error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateMedicalHistoryRequest $request, Patient $patient)
    {
        try {
            $validatedData = $request->validated();
            $result = $this->medicalHistoryModel->updateMedicalHistory($validatedData, $patient);

            if ($result) {
                return redirect()->route('show.patient.record', $patient)->with('message', 'Medical history was updated successfully');
            } else {
                return redirect()->route('show.patient.record', $patient)->with('error', 'Failed to update medical history');
            }
        } catch (Exception $e) {
            // Log the error
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
