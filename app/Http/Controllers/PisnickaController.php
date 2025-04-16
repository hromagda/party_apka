<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Pisnicka;
use App\Http\Requests\PisnickaStoreRequest;

class PisnickaController extends Controller
{
    use AuthorizesRequests;

    /**
     * Zobrazuje seznam písniček s paginací.
     *
     * Tato metoda načte všechny písničky z databáze a zobrazuje je na stránce.
     * Používá stránkování (10 písniček na stránku).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Načteme písničky s paginací (10 písniček na stránku)
        $pisnicky = \App\Models\Pisnicka::paginate(10);
        return view('pisnicky', compact('pisnicky')); // Zobrazíme pohled s písničkami
    }

    /**
     * Ukládá novou písničku do databáze.
     *
     * Tato metoda přijme validovaný požadavek a vytvoří nový záznam o písničce
     * v databázi. Po úspěšném uložení uživatele přesměruje na seznam písniček.
     *
     * @param  \App\Http\Requests\PisnickaStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PisnickaStoreRequest $request)
    {
        // Vytvoříme nový záznam o písničce na základě validovaných dat z formuláře
        Pisnicka::create($request->all());

        // Po uložení přesměrujeme uživatele na seznam písniček
        return redirect('/pisnicky');
    }

    /**
     * Označuje písničku jako zahranou.
     *
     * Tato metoda označí písničku jako zahranou (nastaví příznak `zahrano` na true).
     * Před provedením akce ověří, zda má uživatel potřebná oprávnění.
     * Pokud uživatel nemá oprávnění, akce bude zamítnuta.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function oznacitZahranou($id)
    {
        // Ověření, zda má uživatel oprávnění označit písničku jako zahranou
        $this->authorize('oznacit_pisnicku_jako_zahranou');

        // Najdeme písničku podle ID, nebo vyvoláme chybu, pokud neexistuje
        $pisnicka = \App\Models\Pisnicka::findOrFail($id);

        // Nastavíme příznak 'zahrano' na true
        $pisnicka->zahrano = true;
        $pisnicka->save(); // Uložíme změnu

        // Po úspěšném označení přesměrujeme na seznam písniček
        return redirect()->route('pisnicky.index');
    }
}
