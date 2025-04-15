<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Tento kontrolér bude dostupný pouze pro uživatele s rolí admin
    public function __construct()
    {
        $this->middleware('role:admin'); // Zajistí, že tento kontrolér budou mít přístup pouze administrátoři
    }

    // Metoda pro zobrazení hlavní administrátorské stránky
    public function index()
    {
        // Na této stránce budeme mít seznam všech uživatelů a možnost jejich správy
        $users = User::all(); // Získáme všechny uživatele z databáze
        return view('admin.index', compact('users')); // Předáme seznam uživatelů do pohledu
    }

    // Metoda pro zobrazení formuláře pro editaci uživatele
    public function edit(User $user)
    {
        return view('admin.edit', compact('user')); // Předáme uživatele do pohledu pro editaci
    }

    // Metoda pro aktualizaci údajů uživatele
    public function update(Request $request, User $user)
    {
        // Validace vstupních dat (přidání pravidel podle potřeby)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Přidej další validace podle potřeby
        ]);

        // Aktualizace údajů uživatele
        $user->update($validated);

        return redirect()->route('user-management.index')->with('success', 'Uživatel byl úspěšně aktualizován.');
    }

    // Metoda pro smazání uživatele
    public function destroy(User $user)
    {
        $user->delete(); // Smazání uživatele z databáze

        return redirect()->route('user-management.index')->with('success', 'Uživatel byl úspěšně smazán.');
    }
}
