<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendancePredictionController;

Route::get('/', [AttendancePredictionController::class, 'index']);
Route::post('/predict', [AttendancePredictionController::class, 'predict'])->name('predict');
