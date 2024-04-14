<?php

use Illuminate\Support\Facades\Route;

// ==========frontend routes=========
Route::name('frontend.')->group(function () {
    require __DIR__ . '/frontend.php';
});
// ===================================

// ==========Admin Routes============
Route::prefix('admin')->group(function () {
    require __DIR__ . '/admin.php';
});
// ==================================
