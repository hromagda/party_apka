<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vzkaz;
use App\Http\Requests\VzkazStoreRequest;

class VzkazController extends Controller
{
    public function index()
    {
        $vzkazy = Vzkaz::latest()->paginate(10);

        $barvy = [
            '#ce93d8', // světle fialová
            '#ba68c8', // základní fialová
            '#ab47bc',
            '#9c27b0',
            '#8e24aa'
        ];


        return view('vzkazy', compact('vzkazy', 'barvy'));
    }

    public function store(VzkazStoreRequest $request)
    {
        Vzkaz::create($request->all());
        return redirect('/vzkazy');
    }
}
