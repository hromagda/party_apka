<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PisnickaController extends Controller
{
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
}
