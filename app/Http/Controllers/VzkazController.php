<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VzkazController extends Controller
{
    public function index()
    {
        return view('vzkazy', ['vzkazy' => \App\Models\Vzkaz::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jmeno' => 'required',
            'text' => 'required',
        ]);

        \App\Models\Vzkaz::create($request->all());
        return redirect('/vzkazy');
    }
}
