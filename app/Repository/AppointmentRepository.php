<?php

namespace App\Repository;

use Carbon\Carbon;
use App\Models\Appointment;

class AppointmentRepository
{

    public function showHistory()
    {
        return Appointment::where('status', '!=', 'booked')->orderBy('date')->orderBy('time')->paginate(10);
    }

    public function showUserAppointments($user_id)
    {
        return Appointment::where('user_id', $user_id)->orderBy('date', 'desc')->paginate(5);
    }

    public function cancelAllBookInThePast()
    {
        $currentDate = Carbon::now();
        // Fetch all booked appointments with dates in the past
        $appointments = Appointment::where('status', 'booked')
            ->where('date', '<', $currentDate->toDateString())
            ->get();

        // Update the status to 'cancelled'
        foreach ($appointments as $appointment) {
            $appointment->status = 'cancelled';
            $appointment->save();
        }
    }
}
