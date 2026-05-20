@extends('layouts.layout')

@section('content')
<div class="container" style="max-width: 700px; margin: 20px auto; padding: 20px;">
    <h2>Editar Persona</h2>

    @if($errors->any())
        <div style="margin-bottom: 20px; color: #b91c1c;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('personas.update', $persona) }}">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $persona->nombre) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Apellido</label>
            <input type="text" name="apellido" value="{{ old('apellido', $persona->apellido) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Edad</label>
            <input type="number" name="edad" value="{{ old('edad', $persona->edad) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Correo</label>
            <input type="email" name="correo" value="{{ old('correo', $persona->correo) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Celular</label>
            <input type="text" name="celular" value="{{ old('celular', $persona->celular) }}" required style="width: 100%;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Personaje favorito</label>
            <input type="text" name="personaje_favorito" value="{{ old('personaje_favorito', $persona->personaje_favorito) }}" required style="width: 100%;">
        </div>

        <button type="submit" style="padding: 10px 15px; background-color: #2563eb; color: #fff; border: none;">Actualizar datos</button>
        <a href="{{ route('personas.index') }}" style="margin-left: 15px; color: #333;">Volver al listado</a>
    </form>
</div>
@endsection
