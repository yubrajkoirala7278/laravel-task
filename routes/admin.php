<?php

use App\Http\Controllers\Admin\ExportController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [ExportController::class, 'index'])->name('admin.dashboard');
Route::post('/convert-to-csv', [ExportController::class, 'convertJsonToCsv'])->name('admin.upload.json');
Route::get('/download-csv', [ExportController::class, 'downloadCsv'])->name('admin.export.csv');
