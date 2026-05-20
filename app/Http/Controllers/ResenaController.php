<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Resena;

class ResenaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'contenido' => 'required|string|min:5',
            'rating' => 'required|integer|min:1|max:5',
            'producto' => 'required|string|max:255',
            'tiempo_llegada' => 'required|string|max:100',
            'estado_paquete' => 'required|string|max:100',
        ]);

        Resena::create([
            'user_id' => Auth::id(),
            'contenido' => $request->contenido,
            'rating' => $request->rating,
            'producto' => $request->producto,
            'tiempo_llegada' => $request->tiempo_llegada,
            'estado_paquete' => $request->estado_paquete,
        ]);

        return redirect()->route('dashboard')->with('success', 'Opinión publicada correctamente.');
    }

    public function edit(Resena $resena)
    {
        if (Auth::id() !== $resena->user_id) {
            return redirect()->route('dashboard')->with('error', 'No puede editar esta publicación.');
        }

        return view('resenas.edit', compact('resena'));
    }

    public function update(Request $request, Resena $resena)
    {
        if (Auth::id() !== $resena->user_id) {
            return redirect()->route('dashboard')->with('error', 'No puede actualizar esta publicación.');
        }

        $request->validate([
            'contenido' => 'required|string|min:5',
            'rating' => 'required|integer|min:1|max:5',
            'producto' => 'required|string|max:255',
            'tiempo_llegada' => 'required|string|max:100',
            'estado_paquete' => 'required|string|max:100',
        ]);

        $resena->update($request->only(['contenido', 'rating', 'producto', 'tiempo_llegada', 'estado_paquete']));

        return redirect()->route('dashboard')->with('success', 'Publicación actualizada correctamente.');
    }

    public function destroy(Resena $resena)
    {
        if (Auth::id() !== $resena->user_id) {
            return redirect()->route('dashboard')->with('error', 'No puede eliminar esta publicación.');
        }

        $resena->delete();

        return redirect()->route('dashboard')->with('success', 'Publicación eliminada correctamente.');
    }
}
