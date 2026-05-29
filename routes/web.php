<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\VehicleController as AdminVehicleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/catalogue', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/application/{vehicle}', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/application/{vehicle}', [ApplicationController::class, 'store'])->name('application.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Remplace ton ancienne ligne par celle-ci (en utilisant le chemin complet en texte) :
    Route::get('applications', ['\App\Http\Controllers\Admin\VehicleController', 'listApplications'])->name('applications.index');
    
    // Tes autres routes...
    Route::get('vehicles/{vehicle}/documents', ['\App\Http\Controllers\Admin\VehicleController', 'uploadDocuments'])->name('vehicles.documents');
    Route::post('vehicles/{vehicle}/documents', ['\App\Http\Controllers\Admin\VehicleController', 'storeDocument'])->name('vehicles.documents.store');
    Route::resource('vehicles', '\App\Http\Controllers\Admin\VehicleController');
});

require __DIR__ . '/auth.php';
