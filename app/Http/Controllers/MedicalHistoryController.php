<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMedicalHistoryRequest;
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

            if (!$result) {
                emotify('error', 'Failed to add medical history');
                return redirect()->route('show.patient.record', $validatedData['patient_id']);
            }
            emotify('success', 'Medical history added successfully');
            return redirect()->route('show.patient.record', $validatedData['patient_id']);
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

            if (!$result) {
                emotify('error', 'Failed to update medical history');
                return redirect()->route('show.patient.record', $patient);
            }
            emotify('success', 'Medical history was updated successfully');
            return redirect()->route('show.patient.record', $patient);
        } catch (Exception $e) {
            // Log the error
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
