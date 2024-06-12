<?php

namespace App\Services;

use App\Models\Service;
use Carbon\CarbonPeriod;
use App\Models\Appointment;
use App\Models\BusinessHour;

class AppointmentService
{
    public function getAppointmentById($appointment_id)
    {
        return Appointment::findOrFail($appointment_id);
    }

    public function getServiceById($service_id)
    {
        $service = Service::findOrFail($service_id);

        return $service;
    }

    public function getAvailableSlots($days = 6)
    {

        $datePeriod = CarbonPeriod::create(now(), now()->addDays($days));
        $appointments = [];
        foreach ($datePeriod as $date) {
            $dayName = $date->format('l');

            $businessHours = BusinessHour::where('day', $dayName)->first();
            $hours = array_filter($businessHours->TimesPeriod);

            $currentAppointments = Appointment::where('date', $date->toDateString())->where('status', '!=', 'cancelled')->pluck('time')->map(function ($time) {
                return $time->format('H:i');
            })->toArray();

            $availableHours = array_diff($hours, $currentAppointments);
            $appointments[] = [
                'day_name' => $dayName,
                'date' => $date->format('d M'),
                'full_date' => $date->format('Y-m-d'),
                'off' => $businessHours->off,
                'business_hours' => $hours,
                'reserved_hours' => $currentAppointments,
                'available_hours' => $availableHours
            ];
        }

        return $appointments;
    }
}
