<?php

namespace App\Http\Controllers;

use Log;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Patient;
use App\Models\Service;
use Carbon\CarbonPeriod;
use App\Models\Appointment;
use App\Models\BusinessHour;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\AppointmentBooked;
use App\Http\Requests\AppointmentRequest;
use App\Notifications\AppointmentCancelled;
use App\Notifications\AppointmentCompleted;
use Illuminate\Support\Facades\Notification;

class AppointmentController extends Controller
{
    public function showAppointmentHistory()
    {
        $rawAppointments = Appointment::orderBy('date')->orderBy('time')->where('status', '!=', 'booked')->paginate(10);

        foreach ($rawAppointments as $item) {
            // Parse the time and format it as desired
            $formattedTime = Carbon::parse($item->time)->format('H:i');

            // Assign the formatted time to the 'time' property of the appointment object
            $item->time = $formattedTime;
        }

        return view('admin.appointments.history', ['appointments' => $rawAppointments]);
    }

    // show users appointments to that user
    public function showMyAppointments($user_id)
    {
        $appointments = Appointment::where('user_id', $user_id)->paginate(5);

        return view('user.user-appointments', compact('appointments'));
    }

    // display all appointments to admin
    public function displayAppointments()
    {
        // $rawAppointments = Appointment::paginate(10);
        $rawAppointments = Appointment::orderBy('date')->orderBy('time')->where('status', 'booked')->paginate(10);
        foreach ($rawAppointments as $item) {
            // Parse the time and format it as desired
            $formattedTime = Carbon::parse($item->time)->format('H:i');

            // Assign the formatted time to the 'time' property of the appointment object
            $item->time = $formattedTime;
        }

        return view('admin.appointments.view', ['appointments' => $rawAppointments]);
    }

    // display time slots to user
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

    // user store appointment reservation
    public function reserve(AppointmentRequest $request)
    {
        $data = $request->merge(['user_id' => auth()->id()])->toArray();
        unset($data['service_name']);
        $appointment = Appointment::create($data);

        // Dispatch the notification
        // Notification::route('mail', config('mail.from.address'))
        //     ->notify(new AppointmentBooked($data));

        return redirect()->route('user.appointments', auth()->user()->id);
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

    // admin update the status of appointment
    public function update(Request $request, $appointment)
    {
        $appointmentToUpdate = Appointment::findOrFail($appointment);
        $user = User::findOrFail($appointmentToUpdate->user_id);

        $validatedData = $request->validate([
            'status' => 'required|in:booked,cancelled,completed',
            'comment' => 'nullable|string|max:255',
        ]);

        $appointmentToUpdate->update($validatedData);

        if ($appointmentToUpdate->status == 'cancelled') {
            // $user->notify(new AppointmentCancelled($appointmentToUpdate));
        } else if ($appointmentToUpdate->status == 'completed') {
            // $user->notify(new AppointmentCompleted($appointmentToUpdate));
        }

        return back()->with('success', 'Appointment status updated.');
    }

    // user cancel their appointment
    public function userCancel($id)
    {
        $appointment = Appointment::findOrFail($id);

        $bookingTime = $appointment->created_at;
        $currentTime = Carbon::now();

        if ($currentTime->diffInMinutes($bookingTime) < 60) {
            $appointment->delete();
            return back()->with('message', 'Appointment cancelled successfully.');
        } else {
            return response()->json(['message' => 'You cannot cancel this appointment anymore']);
        }
    }

    // admin filter appointments by status
    public function filterByStatus(Request $request)
    {
        $status = $request->query('status');

        if ($status) {
            $appointments = Appointment::orderBy('date')->orderBy('time')->with(['user:id,first_name,last_name,middle_name', 'service:id,name'])
                ->where('status', $status)
                ->get();
        } else {
            $appointments = Appointment::orderBy('date')->orderBy('time')->with(['user:id,first_name,last_name,middle_name', 'service:id,name'])
                ->get();
        }

        return response()->json($appointments);
    }

    // admin filter appointments by date
    public function filterByDate(Request $request)
    {
        $date = $request->query('dateToFilter');
        // Log::info($request->all());

        if ($date) {
            $appointments = Appointment::orderBy('date')->orderBy('time')->with(['user:id,first_name,last_name,middle_name', 'service:id,name'])
                ->where('date', $date)
                ->get();
        } else {
            $appointments = Appointment::orderBy('date')->orderBy('time')->with(['user:id,first_name,last_name,middle_name', 'service:id,name'])
                ->get();
        }

        return response()->json($appointments);
    }
}
