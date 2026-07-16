<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\FacilityTypeController;
use App\Http\Controllers\FacilityFeatureController;
use App\Http\Controllers\OperatingHourController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [BookingController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/student-dashboard', [BookingController::class, 'studentDashboard'])
        ->name('student.dashboard');

    Route::resource('bookings', BookingController::class);

    Route::get('/my-bookings', [BookingController::class, 'myBookings'])
        ->name('bookings.my');

    // Calendar
    Route::get('/calendar', [CalendarController::class, 'index'])
        ->name('calendar.index');

    Route::get('/calendar/events', [CalendarController::class, 'events'])
        ->name('calendar.events');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);

    Route::resource('facilities', FacilityController::class);

    Route::resource('facility-types', FacilityTypeController::class);

    Route::resource('facility-features', FacilityFeatureController::class);

    Route::resource('operating-hours', OperatingHourController::class);

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])
        ->name('reports.pdf');

    Route::get('/reports/excel', [ReportController::class, 'exportExcel'])
        ->name('reports.excel');

    // Booking Approval
    Route::patch('/bookings/{booking}/approve', [BookingController::class, 'approve'])
        ->name('bookings.approve');

    Route::patch('/bookings/{booking}/reject', [BookingController::class, 'reject'])
        ->name('bookings.reject');

    Route::patch('/bookings/{booking}/complete', [BookingController::class, 'complete'])
        ->name('bookings.complete');
});

require __DIR__.'/auth.php';