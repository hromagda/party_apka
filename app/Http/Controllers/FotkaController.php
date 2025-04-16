<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fotka;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\FotkaUploadRequest;

class FotkaController extends Controller
{
    /**
     * Zobrazuje seznam fotek s paginací.
     *
     * Tato metoda načte fotky z databáze, seřadí je podle data vytvoření (od nejnovějších)
     * a zobrazí je na stránce s použitím stránkování (12 fotek na stránku).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Načteme fotky seřazené podle data vytvoření (desc) s paginací
        $fotky = \App\Models\Fotka::orderBy('created_at', 'desc')->paginate(12); // 12 na stránku
        return view('fotky', ['fotky' => $fotky]); // Zobrazíme pohled s fotkami
    }

    /**
     * Ukládá nahranou fotku do úložiště a databáze.
     *
     * Tato metoda zpracuje soubor nahraný uživatelem, uloží ho do veřejného úložiště
     * a vytvoří nový záznam v databázi s informacemi o fotce (název souboru, původní název).
     * V případě chyby se vrátí zpět na formulář s chybovou hláškou.
     *
     * @param  \App\Http\Requests\FotkaUploadRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FotkaUploadRequest $request)
    {
        // Zkontrolujeme, zda uživatel odeslal soubor
        if ($request->hasFile('soubor')) {
            // Načteme soubor
            $soubor = $request->file('soubor');

            // Zkontrolujeme, zda je soubor platný
            if ($soubor->isValid()) {
                try {
                    // Uložení souboru do veřejného úložiště (adresář 'fotky')
                    $path = $soubor->store('fotky', 'public');
                    $nazev = basename($path); // Získáme název souboru
                    $puvodniNazev = $soubor->getClientOriginalName(); // Získáme původní název souboru

                    // Uložíme záznam o fotce do databáze
                    Fotka::create([
                        'nazev_souboru' => $nazev,
                        'puvodni_nazev' => $puvodniNazev,
                    ]);

                    // Po úspěšném nahrání fotky přesměrujeme zpět na seznam fotek s úspěšnou zprávou
                    return redirect()->route('fotky.index')->with('success', 'Fotka byla nahrána!');
                } catch (\Exception $e) {
                    // Pokud dojde k chybě při nahrávání, logujeme chybu a zobrazíme chybovou zprávu
                    Log::error('Chyba při nahrávání fotky: ' . $e->getMessage());

                    return redirect()->back()->with('error', 'Došlo k chybě při ukládání fotky. Zkuste to prosím znovu.');
                }
            }
        }

        // Pokud soubor nebyl nahrán nebo je neplatný, vrátíme zpět na formulář s chybovou zprávou
        return redirect()->back()->with('error', 'Soubor nebyl nahrán. Zkontrolujte, zda je soubor platný.');
    }
}
