<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Pisnicka;

class PisnickaController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        return view('pisnicky', ['pisnicky' => \App\Models\Pisnicka::all()]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'interpret' => 'required',
            'nazev' => 'required',
            'objednavatel' => 'required',
        ]);

        \App\Models\Pisnicka::create($request->all());
        return redirect('/pisnicky');
    }

    public function oznacitZahranou($id)
    {
        $this->authorize('oznacit_pisnicku_jako_zahranou'); // Ověření oprávnění pro DJ nebo admina

        $pisnicka = \App\Models\Pisnicka::findOrFail($id);
        $pisnicka->zahrano = true;
        $pisnicka->save();

        return redirect()->route('pisnicky.index');
    }
}
