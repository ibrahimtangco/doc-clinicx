<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Activitylog\ActivityLogger;

class MedicalHistory extends Model
{
    use HasFactory;

    protected $table = 'medical_history';

    protected $fillable = [
        'patient_id',
        'condition',
        'description',
        'diagnosed_date',
        'treatment',
        'status',
    ];

    protected $casts = [
        'diagnosed_date' => 'date',
    ];

    public function getDiagnosedDateFormattedAttribute()
    {
        return $this->diagnosed_date->format('F j, Y');
    }

    public function storeMedicalHistory($data)
    {
        return MedicalHistory::create($data);
    }

    public function updateMedicalHistory($data, $patient)
    {
        $medicalHistory = MedicalHistory::where('patient_id', $patient->id)
            ->where('id', $data['id'])
            ->first();
        unset($data['id']);

        return $medicalHistory->update($data);
    }

    public function showUserMedicalHistory($patient)
    {
        return MedicalHistory::where('patient_id', $patient->id)->paginate(5);
    }
}
