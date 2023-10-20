<?php

use App\Http\Controllers\EmployeeController;
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
    return redirect(route('employees.index'));
});

Route::resource('employees', EmployeeController::class, [
    'except' => ['show']
]);

Route::group(['prefix' => 'employees'], function () {
    Route::patch('{employee}/archive', [EmployeeController::class, 'archive'])->name('employees.archive');
    Route::patch('{employee}/restore', [EmployeeController::class, 'restore'])->name('employees.restore');
});
