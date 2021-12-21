<?php

use App\Http\Controllers\Api\SuratKeluarController;
use App\Http\Controllers\Api\SuratMasukController;
use App\Http\Controllers\DisposisiController;
use Illuminate\Support\Facades\Route;

Route::get('/disposisi/{id}/cetak', [DisposisiController::class, 'cetak']);
Route::get('/laporan/surat-masuk/{daterange}', [SuratMasukController::class, 'laporanTgl']);
Route::get('/laporan/surat-keluar/{daterange}', [SuratKeluarController::class, 'laporanTgl']);

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');




