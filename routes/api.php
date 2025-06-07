<?php
use App\Http\Controllers\PisnickaController;
use App\Http\Controllers\VzkazController;
use Illuminate\Support\Facades\Route;

// API routy pro AJAX
Route::get('/pisnicky', [PisnickaController::class, 'getPisnicky'])->name('api.pisnicky.index');
Route::get('/vzkazy', [VzkazController::class, 'getVzkazy'])->name('api.vzkazy.index');
