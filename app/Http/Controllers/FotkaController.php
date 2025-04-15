<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FotkaController extends Controller
{
    public function index()
    {
        return view('fotky', ['fotky' => \App\Models\Fotka::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fotka' => 'required|image|max:2048',
        ]);

        $soubor = $request->file('fotka');
        $nazev = uniqid() . '.' . $soubor->getClientOriginalExtension();
        $puvodniNazev = $soubor->getClientOriginalName();

        $soubor->storeAs('public/fotky', $nazev);

        \App\Models\Fotka::create([
            'nazev_souboru' => $nazev,
            'puvodni_nazev' => $puvodniNazev,
        ]);

        return redirect('/fotky');
    }
}
