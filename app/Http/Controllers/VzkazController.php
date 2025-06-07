<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vzkaz;
use App\Http\Requests\VzkazStoreRequest;

class VzkazController extends Controller
{
    /**
     * Zobrazuje seznam vzkazů s paginací.
     *
     * Tato metoda načte všechny vzkazy z databáze, seřadí je od nejnovějšího
     * a zobrazí je na stránce s použitím stránkování (10 vzkazů na stránku).
     * Také definuje barvy pro zobrazení vzkazů.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Načteme vzkazy v sestupném pořadí podle data (nejnovější první)
        $vzkazy = Vzkaz::latest()->paginate(10);

        // Definujeme barvy, které budou použity pro zobrazení vzkazů
        $barvy = [
            '#ce93d8', // světle fialová
            '#ba68c8', // základní fialová
            '#ab47bc',
            '#9c27b0',
            '#8e24aa'
        ];

        // Zobrazíme pohled s vzkazy a barvami
        return view('vzkazy', compact('vzkazy', 'barvy'));
    }

    /**
     * Ukládá nový vzkaz do databáze.
     *
     * Tato metoda přijme validovaný požadavek a vytvoří nový záznam o vzkazu
     * v databázi. Po úspěšném uložení uživatele přesměruje na seznam vzkazů.
     *
     * @param  \App\Http\Requests\VzkazStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(VzkazStoreRequest $request)
    {
        // Vytvoříme nový záznam o vzkazu na základě validovaných dat z formuláře
        Vzkaz::create($request->all());

        // Po uložení přesměrujeme uživatele na seznam vzkazů
        return redirect('/vzkazy');
    }

    public function getVzkazy()
    {
        $vzkazy = Vzkaz::latest()->paginate(10); // Můžeš upravit podle potřeby
        return response()->json($vzkazy); // Vrátí data ve formátu JSON
    }
}
