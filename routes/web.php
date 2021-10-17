<?php

use App\Http\Controllers\BloodPressureController;
use App\Http\Controllers\PatientsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        $patients = \App\Models\Patient::all()->count();
        $bloodRecords = \App\Models\BloodPressure::all()->count();
        return view('dashboard', ['patients'=>$patients, 'bloodRecords' => $bloodRecords]);
    })->name('dashboard');

    Route::get('dashboard/patients', [PatientsController::class, 'index'])->name('patients');
    Route::get('dashboard/patients/create', [PatientsController::class, 'create'])->name('patients.create');
    Route::get('dashboard/patients/export',  [PatientsController::class, 'export'])->name('patients.export');
    Route::get('dashboard/patients/{patient}', [PatientsController::class, 'show'])->name('patients.show');
    Route::post('dashboard/patients', [PatientsController::class, 'store'])->name('patients.store');

    Route::get('dashboard/blood-pressure/export/{patient}',  [BloodPressureController::class, 'export'])->name('bloodPressure.export');

});


require __DIR__ . '/auth.php';
