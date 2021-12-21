<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\NomorSuratController;
use App\Http\Controllers\Api\SuratKeluarController;
use App\Http\Controllers\Api\SuratMasukController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware'=>['auth:api']],function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/userLogin', [AuthController::class, 'user']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/surat-masuk', [SuratMasukController::class, 'store']);
    Route::get('/surat-masuk', [SuratMasukController::class, 'index']);
    Route::get('/surat-masuk/{id}', [SuratMasukController::class, 'surat']);
    Route::patch('/surat-masuk/{id}', [SuratMasukController::class, 'update']);
    Route::get('/surat-keluar', [SuratKeluarController::class, 'index']);
    Route::post('/surat-keluar', [SuratKeluarController::class, 'store']);
    Route::get('/surat-keluar/{id}', [SuratKeluarController::class, 'surat']);
    Route::patch('/surat-keluar/{id}', [SuratKeluarController::class, 'update']);
    Route::get('/nomor-surat', [NomorSuratController::class, 'index']);
    Route::get('/nomor-surat/{id}', [NomorSuratController::class, 'nomor']);
    Route::patch('/nomor-surat/{id}', [NomorSuratController::class, 'update']);
    Route::post('/nomor-surat', [NomorSuratController::class, 'store']);
});
