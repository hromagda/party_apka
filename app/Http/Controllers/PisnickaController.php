<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Pisnicka;
use App\Http\Requests\PisnickaStoreRequest;


class PisnickaController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $pisnicky = \App\Models\Pisnicka::paginate(10); // paginace pro 10 záznamů na stránku
        return view('pisnicky', compact('pisnicky'));
    }

    public function store(PisnickaStoreRequest $request)
    {
        Pisnicka::create($request->all());
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
