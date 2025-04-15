<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PisnickaController;
use App\Http\Controllers\VzkazController;
use App\Http\Controllers\FotkaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Welcome stránka pro všechny (hosté i přihlášení)
Route::get('/', function () {
return view('welcome');
});

// Přístupné pro všechny (hosté i přihlášení)
Route::get('/pisnicky', [PisnickaController::class, 'index'])->name('pisnicky.index');
Route::post('/pisnicky', [PisnickaController::class, 'store'])->name('pisnicky.store'); // bez middleware, povoleno i hostům

Route::get('/vzkazy', [VzkazController::class, 'index'])->name('vzkazy.index');
Route::post('/vzkazy', [VzkazController::class, 'store'])->name('vzkazy.store'); // taky pro všechny

Route::get('/fotky', [FotkaController::class, 'index'])->name('fotky.index');
Route::post('/fotky', [FotkaController::class, 'store'])->name('fotky.store');

// Login a registrace pro administrátory a DJ
require __DIR__.'/auth.php';

// Zajištění přístupu pro přihlášené
Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/dashboard', function () {
return view('welcome'); // Welcome stránka po přihlášení
})->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Admin routes pro administrátory
Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('/admin', [AdminController::class, 'index'])->name('user-management.index');
Route::get('/admin/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/edit/{user}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/delete/{user}', [AdminController::class, 'destroy'])->name('admin.delete');
});
