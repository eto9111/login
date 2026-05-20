@extends('layouts.layout')

@section('content')
<div class="container" style="max-width: 700px; margin: 20px auto; padding: 20px;">
    <h2>Crear mi perfil en la comunidad</h2>

    <div style="background-color: #eef2ff; border: 1px solid #c7d2fe; border-radius: 10px; padding: 18px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(96, 165, 250, 0.12);">
        <h3 style="margin-top: 0; color: #3730a3;">Contáctanos</h3>
        <div style="display: grid; gap: 12px;">
            <div style="background-color: #fff; padding: 12px; border-radius: 8px; border: 1px solid #dbeafe;">
                <strong>Samir Emmanuel Banda Zambrano</strong><br>
                <a href="mailto:sebanda.9640@unicesmag.edu.co" style="color: #1d4ed8; text-decoration: none;">sebanda.9640@unicesmag.edu.co</a><br>
                <span style="color: #475569;">3189827377</span>
            </div>
            <div style="background-color: #fff; padding: 12px; border-radius: 8px; border: 1px solid #dbeafe;">
                <strong>Yoseph Emanuel Constain Lasso</strong><br>
                <a href="mailto:lassoyoseph@gmail.com" style="color: #1d4ed8; text-decoration: none;">lassoyoseph@gmail.com</a><br>
                <span style="color: #475569;">3166482349</span>
            </div>
        </div>
    </div>

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
            <select name="personaje_favorito" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                <option value="">Selecciona tu personaje favorito</option>
                <option value="Seijūrō Akashi" {{ old('personaje_favorito') == 'Seijūrō Akashi' ? 'selected' : '' }}>Seijūrō Akashi</option>
                <option value="Daiki Aomine" {{ old('personaje_favorito') == 'Daiki Aomine' ? 'selected' : '' }}>Daiki Aomine</option>
                <option value="Shintarō Midorima" {{ old('personaje_favorito') == 'Shintarō Midorima' ? 'selected' : '' }}>Shintarō Midorima</option>
                <option value="Atsushi Murasakibara" {{ old('personaje_favorito') == 'Atsushi Murasakibara' ? 'selected' : '' }}>Atsushi Murasakibara</option>
                <option value="Ryōta Kise" {{ old('personaje_favorito') == 'Ryōta Kise' ? 'selected' : '' }}>Ryōta Kise</option>
                <option value="Tetsuya Kuroko" {{ old('personaje_favorito') == 'Tetsuya Kuroko' ? 'selected' : '' }}>Tetsuya Kuroko</option>
            </select>
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
