<?php

use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'verified', 'approved'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('not-approved', [DonorController::class, 'notApproved'])->name('donor.not.approved');
});

Route::middleware(['auth', 'approved'])->group(function () {
    # profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    # donor routes
    Route::get('/donors/requests', [DonorController::class, 'donorRequests'])->name('donor.requests')->middleware('can:view-donors-requests');
    Route::put('/approve/donor/{id}', [DonorController::class, 'approveDonor'])->name('approve.donor')->middleware('can:approve-donor');
    Route::put('/reject/donor/{id}', [DonorController::class, 'rejectDonor'])->name('reject.donor')->middleware('can:reject-donor');
    Route::get('/donors', [DonorController::class, 'index'])->name('donors.index')->middleware('can:view-donors-list');
    Route::delete('donor/{id}', [DonorController::class, 'destroy'])->name('donor.delete')->middleware('can:delete-donor');
    Route::put('/block/donor/{id}', [DonorController::class, 'blockDonor'])->name('donor.block')->middleware('can:block-donor');
    Route::get('donor/create', [DonorController::class, 'create'])->name('donor.create')->middleware('can:add-donor');
    Route::post('donor/store', [DonorController::class, 'store'])->name('donor.store')->middleware('can:add-donor');
    Route::get('/donors/search', [DonorController::class, 'search'])->name('donors.search');
    Route::get('/blocked-donors', [DonorController::class, 'blockedDonors'])->name('blocked.donors');
    Route::put('/unblock/donor/{id}', [DonorController::class, 'unblockDonor'])->name('donor.unblock')->middleware('can:unblock-donor');

    # blood request routes
    Route::get('/donation-requests', [BloodRequestController::class, 'donationRequests'])->name('donation.requests.index')->middleware('can:view-blood-donation-requests');
    Route::post('/blood-request', [BloodRequestController::class, 'store'])->name('blood.request');
    Route::get('/blood-requests', [BloodRequestController::class, 'index'])->name('blood.requests.index')->middleware('can:view-blood-requests');

    # patient routes
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index')->middleware('can:view-patients-list');
    Route::delete('/patient/{id}', [PatientController::class, 'destroy'])->name('patient.delete')->middleware('can:delete-patients');

    # donation routes
    Route::post('/blood-donate/{patientId}', [DonationController::class, 'store'])->name('donate.blood');

    # message controller
    Route::get('/notifications/{id}', [MessageController::class, 'showNotification'])->name('notifications.show');
    Route::get('/notifications', [MessageController::class, 'allNotifications'])->name('notifications');
    Route::delete('/notifications/{id}', [MessageController::class, 'deleteNotification'])->name('notifications.destroy');
    Route::resource('messages', MessageController::class)->names('messages')->except(['index', 'store']);
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index')->middleware('can:view-messages');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('can:send-messages');
});

require __DIR__.'/auth.php';
