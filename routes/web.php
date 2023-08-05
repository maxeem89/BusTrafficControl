<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\SubscriptionController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/


Auth::routes();

// Grouping routes and applying 'auth' middleware
Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('employees', EmployeeController::class);
    Route::post('/import', [EmployeeController::class,'import'])->name('import');
     Route::get('/employees/downloadQR/{employee}', [QrCodeController::class,'generateQrCode'])->name('employees.downloadQR');;
    //Route::get('employees/downloadQR/{employee}', '@downloadQR')->name('employees.downloadQR');
    Route::put('/employee/transportation/{employee}',  [EmployeeController::class,'updateTransportationStatus'])->name('employee.transportation.update');
    Route::get('/employee/check-qr',  [SubscriptionController::class,'test'])->name('employee.check-qr');


});

