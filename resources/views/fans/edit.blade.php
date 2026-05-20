@extends('layouts.layout')

@section('content')
<div class="container" style="max-width: 700px; margin: 20px auto; padding: 20px;">
    <h2>Editar Fan</h2>

    @if($errors->any())
        <div style="margin-bottom: 20px; color: #b91c1c;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('fans.update', $fan) }}">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $fan->nombre) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Correo</label>
            <input type="email" name="correo" value="{{ old('correo', $fan->correo) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Edad</label>
            <input type="number" name="edad" value="{{ old('edad', $fan->edad) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Personaje favorito</label>
            <input type="text" name="personaje_favorito" value="{{ old('personaje_favorito', $fan->personaje_favorito) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Equipo favorito</label>
            <input type="text" name="equipo_favorito" value="{{ old('equipo_favorito', $fan->equipo_favorito) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Motivo</label>
            <textarea name="motivo" rows="4" required style="width: 100%;">{{ old('motivo', $fan->motivo) }}</textarea>
        </div>

        <button type="submit" style="padding: 10px 15px; background-color: #2563eb; color: #fff; border: none;">Actualizar fan</button>
        <a href="{{ route('comentarios.index') }}" style="margin-left: 15px; color: #333;">Volver al listado</a>
    </form>
</div>
@endsection
