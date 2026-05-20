<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capitulo;

class CapituloController extends Controller
{
    public function index()
    {
        $capitulos = Capitulo::all();
        return view('capitulos', compact('capitulos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero' => 'required|integer|min:1',
            'descripcion' => 'required|string',
            'video_url' => 'required|url',
        ]);

        Capitulo::create($request->all());

        return redirect('/capitulos')->with('success', 'Capítulo guardado correctamente.');
    }
}
