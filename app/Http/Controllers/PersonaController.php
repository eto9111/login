<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = Persona::all();
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        return view('personas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:1',
            'correo' => 'required|email|max:255',
            'celular' => 'required|string|max:50',
            'personaje_favorito' => 'required|string|max:255'
        ]);

        Persona::create($request->all());

        return redirect()->route('personas.index')->with('success', 'Datos guardados correctamente');
    }

    public function edit(Persona $persona)
    {
        return view('personas.edit', compact('persona'));
    }

    public function update(Request $request, Persona $persona)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'edad' => 'required|integer|min:1',
            'correo' => 'required|email|max:255',
            'celular' => 'required|string|max:50',
            'personaje_favorito' => 'required|string|max:255'
        ]);

        $persona->update($request->all());

        return redirect()->route('personas.index')->with('success', 'Datos actualizados correctamente');
    }

    public function destroy(Persona $persona)
    {
        $persona->delete();

        return redirect()->route('personas.index')->with('success', 'Registro eliminado correctamente');
    }
}
