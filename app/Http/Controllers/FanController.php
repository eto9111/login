<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fan;
use App\Models\Resena;

class FanController extends Controller
{
    public function index()
    {
        $fans = Fan::all();
        $resenas = Resena::with('user')->latest()->get();

        return view('dashboard', compact('fans', 'resenas'));
    }

    public function comentarios()
    {
        $fans = Fan::all();
        return view('comentarios', compact('fans'));
    }

    public function store(Request $request)
    {
        return redirect('/dashboard')->with('info', 'Bienvenido de vuelta');
    }

    public function edit(Fan $fan)
    {
        return view('fans.edit', compact('fan'));
    }

    public function update(Request $request, Fan $fan)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'edad' => 'required|integer|min:1',
            'personaje_favorito' => 'required|string|max:255',
            'equipo_favorito' => 'required|string|max:255',
            'motivo' => 'required|string',
        ]);

        $fan->update($request->all());

        return redirect()->route('comentarios.index')->with('success', 'Fan actualizado correctamente');
    }

    public function destroy(Fan $fan)
    {
        $fan->delete();

        return redirect()->route('comentarios.index')->with('success', 'Fan eliminado correctamente');
    }
}
