<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fotka;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\FotkaUploadRequest;

class FotkaController extends Controller
{
    public function index()
    {
        $fotky = \App\Models\Fotka::orderBy('created_at', 'desc')->paginate(12); // 12 na stránku
        return view('fotky', ['fotky' => $fotky]);
    }

    public function store(FotkaUploadRequest $request)
    {
        if ($request->hasFile('soubor')) {
            $soubor = $request->file('soubor');

            if ($soubor->isValid()) {
                try {
                    // Uložení souboru do storage
                    $path = $soubor->store('fotky', 'public');
                    $nazev = basename($path);
                    $puvodniNazev = $soubor->getClientOriginalName();

                    // Uložení záznamu do databáze
                    Fotka::create([
                        'nazev_souboru' => $nazev,
                        'puvodni_nazev' => $puvodniNazev,
                    ]);

                    return redirect()->route('fotky.index')->with('success', 'Fotka byla nahrána!');
                } catch (\Exception $e) {
                    // Logování chyby pro ladění
                    Log::error('Chyba při nahrávání fotky: ' . $e->getMessage());

                    return redirect()->back()->with('error', 'Došlo k chybě při ukládání fotky. Zkuste to prosím znovu.');
                }
            }
        }

        return redirect()->back()->with('error', 'Soubor nebyl nahrán. Zkontrolujte, zda je soubor platný.');
    }

}
