<?php

namespace App\Services;

use App\Models\Appointment;

class FilterService
{

    public function filterByStatus($status)
    {
        if (!$status) {
            abort(400, 'Status is required');
        }

        $query = Appointment::orderBy('date')
            ->orderBy('time')
            ->with(['user:id,first_name,last_name,middle_name', 'service:id,name']);

        if ($status == 'all') {
            $appointments = $query->where('status', '!=', 'booked')->get();
        } else {
            $appointments = $query->where('status', $status)->get();
        }

        return $appointments;
    }

    public function filterByDate($date)
    {
        $query = Appointment::where('status', 'booked')->orderBy('date')->orderBy('time')->with(['user:id,first_name,last_name,middle_name', 'service:id,name']);

        if ($date) {
            $query->where('date', $date);
        }
        return $query->get();
    }
}
