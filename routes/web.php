<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BarangayController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Feedback\FeedbackController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/import-barangay', [BarangayController::class, 'index']);

// Home Route
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    Route::get('dashboard', [ServiceController::class, 'display'])->name('user.dashboard');
});


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

//! Profile Update Route
Route::middleware('auth')->group(function () {
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
});



//! Admin Route Views
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/appointments', function () {
        return view('admin.appointment');
    })->name('admin.appointments');
    Route::get('admin/inventory', function () {
        return view('admin.inventroy');
    })->name('admin.inventory');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('feedback', [FeedbackController::class, 'create'])->name('send.feedback');
    Route::post('feedback', [FeedbackController::class, 'store']);
});

Route::middleware(['auth', 'role:SuperAdmin'])->group(function () {
    Route::get('superadmin', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('superadmin/profile', [ProfileController::class, 'edit'])->name('superadmin.profile.edit');
});





require __DIR__ . '/auth.php';
