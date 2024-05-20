<?php

use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/employees', [EmployeeController::class,'list_employees'])->name('');
Route::post('/employees', [EmployeeController::class,'create_employee'])->name('');
Route::get('/employees/{id}', [EmployeeController::class,'employee_id'])->name('');