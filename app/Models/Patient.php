<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function storeUPatientDetails($user_id, $validated)
    {
        return Patient::create([
            'user_id' => $user_id,
            'telephone' => $validated['telephone'],
            'birthday' => $validated['birthday'],
            'age' => $validated['age'],
            'status' => $validated['status']
        ]);
    }

    public function updatePatientDetails($patient_id, $validated)
    {
        $patientToUpdate = Patient::findOrFail($patient_id);

        $patientToUpdate->update([
            'telephone' => $validated['telephone'],
            'birthday' => $validated['birthday'],
            'age' => $validated['age'],
            'status' => $validated['status']
        ]);
    }

    public function searchPatient($search)
    {
        return User::where('userType', 'user')
            ->where(function ($query) use ($search) {
                $query->where('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('middle_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('address', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("CONCAT(first_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("CONCAT(last_name, ' ', middle_name) LIKE ?", ['%' . $search . '%'])
                    ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ['%' . $search . '%']);
            })
            ->get();
    }
}
