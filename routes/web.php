<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StoreController;

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');

    // Shift routes ...
    Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');
    Route::post('/shifts/generate', [ShiftController::class, 'generate'])->name('shifts.generate');
    Route::post('/shifts/update', [ShiftController::class, 'update'])->name('shifts.update');
    Route::get('/shifts/{id}/edit', [ShiftController::class, 'edit'])->name('shifts.edit');
    Route::get('/shifts/{id}/history', [ShiftController::class, 'history'])->name('shifts.history');
    Route::get('/shifts/{id}/save', [ShiftController::class, 'save'])->name('shifts.save');

    // Employee routes ...
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.information');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::put('/employees/{employee}/update-preferred-days-off', [EmployeeController::class, 'updatePreferredDaysOff'])->name('employees.updatePreferredDaysOff');
    Route::put('/employees/{employee}/update-preferred-working-days', [EmployeeController::class, 'updatePreferredWorkingDays'])->name('employees.updatePreferredWorkingDays');

    // Store routes ...
    Route::get('/stores/create', [StoreController::class, 'createStore'])->name('stores.create');
    Route::post('/stores', [StoreController::class, 'storeStore'])->name('stores.store');
    Route::get('/stores/{id}/edit', [StoreController::class, 'editStore'])->name('stores.edit');
    Route::put('/stores/{id}', [StoreController::class, 'updateStore'])->name('stores.update');    
    Route::delete('/stores/{id}', [StoreController::class, 'destroy'])->name('stores.destroy');
});