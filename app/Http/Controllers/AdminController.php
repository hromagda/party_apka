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
    /**
     * Konstruktor kontroleru, který zajišťuje přístup pouze pro admina.
     *
     * Tento kontroler bude dostupný pouze pro uživatele s rolí 'admin'.
     */
    public function __construct()
    {
        $this->middleware('role:admin'); // Ochrana pro přístup pouze pro adminy
    }

    /**
     * Zobrazení hlavní administrátorské stránky s seznamem uživatelů.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Získáme všechny uživatele z databáze
        $users = User::all();

        // Vracíme pohled se seznamem uživatelů
        return view('admin.index', compact('users'));
    }

    /**
     * Zobrazení formuláře pro editaci konkrétního uživatele.
     *
     * @param  int  $id  ID uživatele, který se má upravit
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id); // Najdeme uživatele podle ID
        $roles = Role::all(); // Získáme všechny role

        // Vracíme pohled pro editaci uživatele
        return view('admin.edit', compact('user', 'roles'));
    }

    /**
     * Aktualizuje údaje uživatele.
     *
     * @param  \App\Http\Requests\Admin\UserUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        // Najdeme uživatele podle ID a aktualizujeme jeho údaje
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Synchronizujeme roli uživatele
        $user->syncRoles([$request->role]);

        // Po úspěšné změně přesměrování na seznam uživatelů
        return redirect()->route('admin.index')->with('success', 'Uživatel byl upraven.');
    }

    /**
     * Smaže uživatele.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete(); // Smažeme uživatele z databáze

        // Po úspěšném smazání přesměrování na seznam uživatelů
        return redirect()->route('admin.index')->with('success', 'Uživatel byl úspěšně smazán.');
    }

    /**
     * Smaže fotku a její soubor ze storage.
     *
     * @param  \App\Models\Fotka  $fotka
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyFotka(Fotka $fotka)
    {
        try {
            // Smažeme soubor fotky ze storage
            \Storage::disk('public')->delete('fotky/' . $fotka->nazev_souboru);
            $fotka->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Chyba při mazání fotky: ' . $e->getMessage());
        }

        // Po úspěšném smazání fotky přesměrování zpět s úspěšnou zprávou
        return back()->with('success', 'Fotka byla úspěšně smazána.');
    }

    /**
     * Smaže vzkaz.
     *
     * @param  \App\Models\Vzkaz  $vzkaz
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyVzkaz(Vzkaz $vzkaz)
    {
        $vzkaz->delete(); // Smažeme vzkaz z databáze

        // Po úspěšném smazání přesměrování zpět s úspěšnou zprávou
        return back()->with('success', 'Vzkaz byl úspěšně smazán.');
    }
}
