<?php


use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BusinessHourController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\Feedback\FeedbackController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PrintController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/import-barangay', [BarangayController::class, 'index']);
Route::get('/test_log', function () {
    return Activity::all()->last();
    return 'Hello Log';
});
// Home Route
Route::get('/', function () {

    return view('welcome');
});

// User View Services
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('dashboard', [ServiceController::class, 'display'])->name('user.dashboard');

    Route::get('reserve/{service_id}', [AppointmentController::class, 'index']);
    Route::post('reserve', [AppointmentController::class, 'reserve'])->name('reserve.appointment');
    Route::get('user/appointments/{id}', [AppointmentController::class, 'showMyAppointments'])->name('user.appointments');
    Route::post('user/appointment/cancel/{id}', [AppointmentController::class, 'userCancel'])->name('user.appointment.cancel');
    // Route::get('user/appointment/{id}', [AppointmentController::class, 'show'])->name('show.myappointment');

    Route::get('user/appointment/{appointment}', [AppointmentController::class, 'show'])->name('show-appointment');
});

// User Profile Page - Edit
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

//! Profile Update and Delete Route
Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('api/fetch-city', [RegisteredUserController::class, 'fetchCity']);
    Route::post('api/fetch-barangay', [RegisteredUserController::class, 'fetchBarangay']);

    Route::get('/get-cities/{provinceCode}', [ProfileController::class, 'getCities'])->name('profile.getCities');
    Route::get('/get-barangays/{cityCode}', [ProfileController::class, 'getBarangays'])->name('profile.getBarangays');

    Route::get('/appointments/filter', [AppointmentController::class, 'filterByStatus']);
    Route::get('/appointments/filter/date', [AppointmentController::class, 'filterByDate']);
});

//! Admin Route Controller
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    Route::get('admin/profile', [ProfileController::class, 'edit'])
        ->name('admin.profile.edit');

    Route::resource('admin/providers', ProviderController::class);
    Route::get('admin/provider/search', [ProviderController::class, 'search']);

    Route::resource('admin/services', ServiceController::class);
    Route::get('admin/service/search', [ServiceController::class, 'search']);

    Route::resource('admin/patients', PatientController::class);
    Route::get('admin/patient/search', [PatientController::class, 'search']);

    Route::get('admin/patients/record/{patient}', [MedicalHistoryController::class, 'show'])->name('show.patient.record');
    Route::get('admin/business-hours', [BusinessHourController::class, 'index'])->name('admin.business_hours');
    Route::post('admin/business-hours', [BusinessHourController::class, 'update'])->name('business_hours.update');

    Route::get('admin/appointments', [AppointmentController::class, 'displayAppointments'])->name('admin.appointments.view');
    Route::get('admin/appointments/history', [AppointmentController::class, 'showAppointmentHistory'])->name('admin.appointments.history');
    Route::get('admin/edit-appointment/{appointment}', [AppointmentController::class, 'edit'])->name('edit-appointment');
    Route::post('admin/edit-appointment/{appointment}', [AppointmentController::class, 'update']);

    Route::post('admin/api/fetch-city', [RegisteredUserController::class, 'fetchCity']);
    Route::post('admin/api/fetch-barangay', [RegisteredUserController::class, 'fetchBarangay']);

    // API to add providers address
    Route::post('admin/providers/api/fetch-city', [RegisteredUserController::class, 'fetchCity']);
    Route::post('admin/providers/api/fetch-barangay', [RegisteredUserController::class, 'fetchBarangay']);

    // API to add patients address
    Route::post('admin/patients/api/fetch-city', [RegisteredUserController::class, 'fetchCity']);
    Route::post('admin/patients/api/fetch-barangay', [RegisteredUserController::class, 'fetchBarangay']);

    // Medical History
    Route::post('admin/add-medical-history', [MedicalHistoryController::class, 'store'])->name('add.medical.history');
    Route::put('admin/edit-medical-history/{patient}', [MedicalHistoryController::class, 'update'])->name('edit.medical.history');

    Route::resource('admin/products', ProductController::class);
    Route::get('admin/product/search', [ProductController::class, 'search']);

    Route::resource('admin/categories', CategoryController::class);
    Route::get('admin/category/search', [CategoryController::class, 'search']);

    Route::get('admin/prescriptions/{patient}/create', [PrescriptionController::class, 'create'])->name('create.prescription');
    Route::resource('admin/prescriptions', PrescriptionController::class)->names('admin.prescriptions');
    Route::get('admin/download-pdf/{prescription}', [PrintController::class, 'downloadPDF'])->name('admin.prescriptions.downloadPDF');
    Route::get('admin/preview-pdf/{prescription}', [PrintController::class, 'previewPDF'])->name('admin.prescriptions.previewPDF');
});

//! Admin Route Views
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('admin/inventory', function () {
        return view('admin.inventroy');
    })->name('admin.inventory');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('feedback', [FeedbackController::class, 'create'])->name('send.feedback');
    Route::post('feedback', [FeedbackController::class, 'store']);
});

Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
    // Route::get('superadmin', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
    Route::get('superadmin/', [AppointmentController::class, 'displayAppointments'])->name('superadmin.appointments.view');
    Route::get('superadmin/profile', [ProfileController::class, 'edit'])->name('superadmin.profile.edit');
    Route::get('superadmin/appointments/history', [AppointmentController::class, 'showAppointmentHistory'])->name('superadmin.appointments.history');
    Route::get('superadmin/edit-appointment/{appointment}', [AppointmentController::class, 'edit'])->name('edit-appointment');
    Route::post('superadmin/edit-appointment/{appointment}', [AppointmentController::class, 'update']);
    Route::get('superadmin/prescriptions/{patient}/create', [PrescriptionController::class, 'create'])->name('create.prescription');
    Route::resource('superadmin/prescriptions', PrescriptionController::class)->names('superadmin.prescriptions');
    Route::get('superadmin/download-pdf/{prescription}', [PrintController::class, 'downloadPDF'])->name('superadmin.prescriptions.downloadPDF');
    Route::get('superadmin/preview-pdf/{prescription}', [PrintController::class, 'previewPDF'])->name('superadmin.prescriptions.previewPDF');
});





require __DIR__ . '/auth.php';
