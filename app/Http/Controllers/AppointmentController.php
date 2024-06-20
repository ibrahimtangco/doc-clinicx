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
use App\Http\Requests\AppointmentUpdateStatusRequest;
use App\Repository\AppointmentRepository;
use App\Notifications\AppointmentCancelled;
use App\Notifications\AppointmentCompleted;
use App\Services\AppointmentService;
use App\Services\FilterService;
use Illuminate\Support\Facades\Notification;

class AppointmentController extends Controller
{
    protected $appointmentRepository, $appointmentService, $filterService;

    function __construct(
        AppointmentRepository $appointmentRepository,
        AppointmentService $appointmentService,
        FilterService $filterService
    ) {
        $this->appointmentRepository = $appointmentRepository;
        $this->appointmentService = $appointmentService;
        $this->filterService = $filterService;
    }

    public function showAppointmentHistory()
    {
        // return all appointment with CANCELLED and COMPLETED status
        $rawAppointments = $this->appointmentRepository->showHistory();

        $userType = auth()->user()->userType;

        $view = match ($userType) {
            'admin' => 'admin.appointments.history',
            'SuperAdmin' => 'super_admin.appointments.history',
        };

        return view($view, ['appointments' => $rawAppointments]);
    }

    // show users appointments to that user
    public function showMyAppointments($user_id)
    {
        // paginate of 5 entries
        $appointments = $this->appointmentRepository->showUserAppointments($user_id);
        return view('user.user-appointments', compact('appointments'));
    }

    public function show($appointment)
    {
        $appointment = Appointment::findOrFail($appointment);
        $service = Service::where('id', $appointment->service_id)->firstOrFail();
        $user = auth()->user();
        $patient = Patient::where('user_id', $user->id)->firstOrFail();
        $appointmentInfo = [
            'service' => $service,
            'user' => $user,
            'patient' => $patient,
            'appointment' => $appointment
        ];

        // dd($appointmentInfo);
        return view('user.show', compact('appointmentInfo'));
    }
    // display all appointments to admin
    public function displayAppointments()
    {
        //? run this every time booked appointments render to filter out past appointments
        // $this->appointmentRepository->cancelAllBookInThePast();

        $appointments = Appointment::orderBy('time')->where('status', 'booked')->paginate(10);

        $userType = auth()->user()->userType;

        $view = match ($userType) {
            'admin' => 'admin.appointments.view',
            'SuperAdmin' => 'super_admin.appointments.view',
        };

        return view($view, compact('appointments'));
    }

    // display time slots to user
    public function index($service_id)
    {

        $service = $this->appointmentService->getServiceById($service_id);
        // dd($service);
        if (!$service) {
            notify()->error('Service not found');
            return
                redirect()->back();
        }
        $appointments = $this->appointmentService->getAvailableSlots();

        return view('user.reserve', [
            'appointments' => $appointments,
            'service' => $service
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

        if (!$appointment) {
            emotify('error', 'Failed to book appointment');
            return redirect()->route('user.appointments', auth()->user()->id);
        }
        emotify('success', 'Appointment booked successfully');
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

        $userType = auth()->user()->userType;

        $view = match ($userType) {
            'admin' => 'admin.appointments.edit',
            'SuperAdmin' => 'super_admin.appointments.edit'
        };
        return view($view, compact('appointmentInfo'));
    }

    // admin update the status of appointment
    public function update(AppointmentUpdateStatusRequest $request, $appointment)
    {
        $appointmentToUpdate = Appointment::findOrFail($appointment);
        $user = User::findOrFail($appointmentToUpdate->user_id);

        $appointment = $appointmentToUpdate->update($request->validated());

        if ($appointmentToUpdate->status == 'cancelled') {
            // $user->notify(new AppointmentCancelled($appointmentToUpdate));
        } else if ($appointmentToUpdate->status == 'completed') {
            // $user->notify(new AppointmentCompleted($appointmentToUpdate));
        }

        $userType = auth()->user()->userType;

        $route = match ($userType) {
            'admin' => 'admin.appointments.history',
            'SuperAdmin' => 'superadmin.appointments.history'
        };

        if (!$appointment) {
            emotify('error', 'Failed to update appointment status');
            return redirect()->route($route);
        }
        emotify('success', 'Appointment status updated successfully');
        return redirect()->route($route);
    }

    // user cancel their appointment
    public function userCancel($id)
    {
        $appointment = $this->appointmentService->getAppointmentById($id);

        $bookingTime = $appointment->created_at;
        $currentTime = Carbon::now();

        if ($currentTime->diffInMinutes($bookingTime) < 60) {
            $appointment->update(['status' => 'cancelled']);
            emotify('error', 'Appointment cancelled successfully');
            return redirect()->back();
        } else {
            return response()->json(['error' => 'You cannot cancel this appointment anymore']);
        }
    }

    // admin filter appointments by status
    public function filterByStatus(Request $request)
    {
        $appointments = $this->filterService->filterByStatus($request->query('status'));

        return response()->json($appointments);
    }

    // admin filter appointments by date
    public function filterByDate(Request $request)
    {

        $appointments = $this->filterService->filterByDate(
            $request->query('dateToFilter')
        );

        return response()->json($appointments);
    }
}
