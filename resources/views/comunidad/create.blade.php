@extends('layouts.layout')

@section('content')
<div class="container" style="max-width: 700px; margin: 20px auto; padding: 20px;">
    <h2>Crear mi perfil en la comunidad</h2>

    <p style="color: #666; margin-bottom: 20px;">Comparte tu información para que otros fans de Kuroko no Basket puedan contactarte. Tu correo será cargado automáticamente.</p>

    @if($errors->any())
        <div style="margin-bottom: 20px; color: #b91c1c;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('comunidad.store') }}" style="background-color: #f9f9f9; padding: 20px; border-radius: 8px;">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Edad</label>
            <input type="number" name="edad" value="{{ old('edad') }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Personaje favorito</label>
            <input type="text" name="personaje_favorito" value="{{ old('personaje_favorito') }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Equipo favorito</label>
            <select name="equipo_favorito" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                <option value="">Selecciona tu equipo favorito</option>
                <option value="Seirin High School" {{ old('equipo_favorito') == 'Seirin High School' ? 'selected' : '' }}>Seirin High School</option>
                <option value="Kaijo High School" {{ old('equipo_favorito') == 'Kaijo High School' ? 'selected' : '' }}>Kaijo High School</option>
                <option value="Touou Academy" {{ old('equipo_favorito') == 'Touou Academy' ? 'selected' : '' }}>Touou Academy</option>
                <option value="Yosen High School" {{ old('equipo_favorito') == 'Yosen High School' ? 'selected' : '' }}>Yosen High School</option>
                <option value="Shutoku High School" {{ old('equipo_favorito') == 'Shutoku High School' ? 'selected' : '' }}>Shutoku High School</option>
                <option value="Rakuzan High School" {{ old('equipo_favorito') == 'Rakuzan High School' ? 'selected' : '' }}>Rakuzan High School</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">Cuéntale a otros fans sobre ti (mínimo 10 caracteres)</label>
            <textarea name="mensaje" rows="6" required minlength="10" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; resize: vertical;">{{ old('mensaje') }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="background-color: #e3f2fd; padding: 10px; border-radius: 4px; display: block;">
                <strong>Tu correo (automático):</strong> {{ Auth::user()->email }}
            </label>
        </div>

        <div style="text-align: center;">
            <button type="submit" style="padding: 12px 25px; background-color: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Crear perfil</button>
            <a href="{{ route('comunidad.index') }}" style="margin-left: 15px; color: #333;">Volver a la comunidad</a>
        </div>
    </form>
</div>
@endsection
