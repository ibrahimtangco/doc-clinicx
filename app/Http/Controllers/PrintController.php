<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{
    public function downloadPDF(Prescription $prescription)
    {
        $patientNameSlug = str_replace(' ', '-', strtolower($prescription->patient->user->full_name));
        $date = date('m-d-y');
        $title = $date . '_' . $patientNameSlug;

        $pdf = Pdf::loadView('admin.prescription.print_preview', ['prescription' => $prescription]);
        return $pdf->download($title . '.pdf');
    }

    public function previewPDF(Prescription $prescription)
    {
        $patientNameSlug = str_replace(' ', '-', strtolower($prescription->patient->user->full_name));
        $date = date('m-d-y');
        $title = $date . '_' . $patientNameSlug;

        $pdf = Pdf::loadView('admin.prescription.print_preview', ['prescription' => $prescription]);
        return $pdf->stream($title . '.pdf');
    }
}
