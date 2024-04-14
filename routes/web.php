<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


// ==========frontend routes=========
Route::name('frontend.')->group(function () {
    require __DIR__ . '/frontend.php';
});
// ===================================

// ==========Admin Routes============
Route::group(['middleware' => ['web', 'checkAdmin']], function () {
    Route::prefix('admin')->group(function () {
        require __DIR__ . '/admin.php';
    });
});
// ==================================

// ==========Auth===========
Route::get('/auth/redirect', [AuthController::class, 'auth'])->name('auth');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('callback');
// =========================
