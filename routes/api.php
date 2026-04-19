<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rule;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Route::get('/sync-users', [SyncUserController::class, 'syncFromPayroll']);



// routes/api.php
Route::middleware('api.token')->group(function () {

    Route::post('/update-email', [UserController::class, 'updateEmail']);

    Route::delete('/user/{id_karyawan}', [UserController::class, 'destroyByKaryawan']);

    Route::post('/create-user', [UserController::class, 'store']);
});
