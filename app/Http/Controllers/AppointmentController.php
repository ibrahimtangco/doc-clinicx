<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Patient;
use App\Models\Service;
use Carbon\CarbonPeriod;
use App\Models\Appointment;
use App\Models\BusinessHour;
use Illuminate\Http\Request;
use App\Notifications\AppointmentBooked;
use App\Http\Requests\AppointmentRequest;
use App\Notifications\AppointmentCompleted;
use Illuminate\Support\Facades\Notification;

class AppointmentController extends Controller
{

    public function displayAppointments()
    {
        $rawAppointments = Appointment::paginate(10);

        foreach ($rawAppointments as $item) {
            // Parse the time and format it as desired
            $formattedTime = Carbon::parse($item->time)->format('H:i');

            // Assign the formatted time to the 'time' property of the appointment object
            $item->time = $formattedTime;
        }

        return view('admin.appointments.view', ['appointments' => $rawAppointments]);
    }


    public function index($service_id)
    {
        $services = Service::where('id', $service_id)->get();
        $arr = $services->toArray();

        $datePeriod = CarbonPeriod::create(now(), now()->addDays(6));
        $appointments = [];
        foreach ($datePeriod as $date) {
            $dayName = $date->format('l');

            $businessHours = BusinessHour::where('day', $dayName)->first();
            $hours = array_filter($businessHours->TimesPeriod);

            $currentAppointments = Appointment::where('date', $date->toDateString())->pluck('time')->map(function ($time) {
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

        return view('user.reserve', [
            'appointments' => $appointments,
            'service' => $arr[0]
        ]);
    }

    public function reserve(AppointmentRequest $request)
    {
        $data = $request->merge(['user_id' => auth()->id()])->toArray();
        unset($data['service_name']);
        $appointment = Appointment::create($data);

        // Dispatch the notification
        Notification::route('mail', config('mail.from.address'))
            ->notify(new AppointmentBooked($data));

        return view('user.user-appointments');
    }

    public function edit(Appointment $appointment)
    {
        $service = Service::findOrFail($appointment->service_id);
        $user = User::findOrFail($appointment->user_id);
        $patient = Patient::where('user_id', $appointment->user_id)->firstOrFail();



        $appointmentInfo = [
            'service' => $service,
            'user' => $user,
            'patient' => $patient,
            'appointment' => $appointment
        ];
        return view('admin.appointments.edit', compact('appointmentInfo'));
    }

    public function update(Request $request, $appointment)
    {
        $appointmentToUpdate = Appointment::findOrFail($appointment);
        $user = User::findOrFail($appointmentToUpdate->user_id);

        $validatedData = $request->validate([
            'status' => 'required|in:booked,cancelled,completed',
            'comment' => 'nullable|string|max:255',
        ]);

        $updateStatus = $appointmentToUpdate->update($validatedData);
        if ($appointmentToUpdate->status == 'cancelled') {
            dd('cancelled');
        } else if ($appointmentToUpdate->status == 'completed') {
            $user->notify(new AppointmentCompleted());
        }

        return back()->with('success', 'Appointment status updated.');
    }
}
