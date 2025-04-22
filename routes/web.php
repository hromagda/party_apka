<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PisnickaController;
use App\Http\Controllers\VzkazController;
use App\Http\Controllers\FotkaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Welcome stránka pro všechny (hosté i přihlášení)
// Tato routa zobrazuje domovskou stránku aplikace pro všechny uživatele.
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Přístupné pro všechny (hosté i přihlášení)
// Tato routa zobrazuje seznam písniček a umožňuje uživatelům (hostům i přihlášeným) přidávat nové písničky.
Route::get('/pisnicky', [PisnickaController::class, 'index'])->name('pisnicky.index');
Route::post('/pisnicky', [PisnickaController::class, 'store'])->name('pisnicky.store'); // Povolené i pro hosty

// Ochráněné routy pro označení písničky jako zahrané (pouze pro přihlášené s rolí DJ nebo admin)
// Tato skupina rout chrání funkci označení písničky jako zahrané. Pouze přihlášení uživatelé s rolí DJ nebo admin mohou tuto akci provádět.
Route::middleware(['auth', 'role:dj|admin'])->group(function () {
    Route::patch('/pisnicky/{id}/zahrano', [PisnickaController::class, 'oznacitZahranou'])->name('pisnicky.zahrano');
});

// Vzkazy – dostupné pro všechny (hosté i přihlášení)
// Tato routa zobrazuje seznam vzkazů a umožňuje všem uživatelům přidávat nové vzkazy.
Route::get('/vzkazy', [VzkazController::class, 'index'])->name('vzkazy.index');
Route::post('/vzkazy', [VzkazController::class, 'store'])->name('vzkazy.store'); // Povolené i pro hosty

// Fotky – dostupné pro všechny (hosté i přihlášení)
// Tato routa zobrazuje seznam fotek a umožňuje všem uživatelům nahrávat nové fotky.
Route::get('/fotky', [FotkaController::class, 'index'])->name('fotky.index');
Route::post('/fotky', [FotkaController::class, 'store'])->name('fotky.store');

// Login a registrace pro administrátory a DJ
// Autentizační routy pro administrátory a DJ, generované automaticky přes Laravel.
require __DIR__.'/auth.php';

// Zajištění přístupu pro přihlášené uživatele
// Tato skupina rout chrání sekce, které jsou přístupné pouze pro přihlášené uživatele.
Route::middleware(['auth', 'verified'])->group(function () {
    // Stránka s přivítáním po přihlášení (dashboard)
    Route::get('/dashboard', function () {
        return view('welcome'); // Welcome stránka po přihlášení
    })->name('dashboard');

    // Stránka pro úpravu uživatelského profilu
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

// Admin routes pro administrátory
// Tento middleware zabezpečuje, že jen admin může přistupovat k těmto routám pro správu uživatelů a aplikace.
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Správa uživatelů – zobrazení seznamu uživatelů, editace a mazání
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/edit/{user}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete/{user}', [AdminController::class, 'destroy'])->name('admin.delete');

    // Správa aplikace – mazání fotek a vzkazů
    Route::delete('/admin/fotky/{fotka}', [\App\Http\Controllers\AdminController::class, 'destroyFotka'])->name('admin.fotky.delete');
    Route::delete('/admin/vzkazy/{vzkaz}', [\App\Http\Controllers\AdminController::class, 'destroyVzkaz'])->name('admin.vzkazy.delete');
});
