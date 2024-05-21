<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\EmployeeController;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#Employees
Route::get('/employees', [EmployeeController::class,'list_employees'])->name('');
Route::post('/employees', [EmployeeController::class,'create_employee'])->name('');
Route::get('/employees/{id}', [EmployeeController::class,'employee_id'])->name('');
Route::patch('/employees/edit/{id}', [EmployeeController::class, 'employee_update'])->name('');
Route::delete('employees/delete/{id}',[EmployeeController::class,'employee_delete'])->name('');

#Company

Route::get('/companies', [CompanyController::class,'list_companies'])->name('');