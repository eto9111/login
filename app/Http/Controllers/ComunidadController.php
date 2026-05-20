<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contacto;

class ComunidadController extends Controller
{
    public function index()
    {
        $contactos = Contacto::with('user')->latest()->paginate(10);
        return view('comunidad.index', compact('contactos'));
    }

    public function create()
    {
        return view('comunidad.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'edad' => 'required|string|max:3',
            'personaje_favorito' => 'required|string|max:255',
            'equipo_favorito' => 'required|string|max:255',
            'mensaje' => 'required|string|min:10|max:1000',
        ]);

        Contacto::create([
            'user_id' => Auth::id(),
            'nombre' => $request->nombre,
            'correo' => Auth::user()->email,
            'edad' => $request->edad,
            'personaje_favorito' => $request->personaje_favorito,
            'equipo_favorito' => $request->equipo_favorito,
            'mensaje' => $request->mensaje,
        ]);

        return redirect()->route('comunidad.index')->with('success', '¡Tu perfil fue agregado exitosamente! Otros usuarios pueden contactarte.');
    }

    public function show(Contacto $contacto)
    {
        return view('comunidad.show', compact('contacto'));
    }
}
