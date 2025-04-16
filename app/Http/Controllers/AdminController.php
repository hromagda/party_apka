<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Fotka;
use App\Models\Vzkaz;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\UserUpdateRequest;

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
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.edit', compact('user', 'roles'));
    }

    // Metoda pro aktualizaci údajů uživatele
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->route('admin.index')->with('success', 'Uživatel byl upraven.');
    }

    // Metoda pro smazání uživatele
    public function destroy(User $user)
    {
        $user->delete(); // Smazání uživatele z databáze

        return redirect()->route('admin.index')->with('success', 'Uživatel byl úspěšně smazán.');
    }

    public function destroyFotka(Fotka $fotka)
    {
        // smažeme soubor ze storage
        try {
            \Storage::disk('public')->delete('fotky/' . $fotka->nazev_souboru);
            $fotka->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Chyba při mazání fotky: ' . $e->getMessage());
        }
        $fotka->delete();

        return back()->with('success', 'Fotka byla úspěšně smazána.');
    }

    public function destroyVzkaz(Vzkaz $vzkaz)
    {
        $vzkaz->delete();
        return back()->with('success', 'Vzkaz byl úspěšně smazán.');
    }
}
