@extends('layouts.layout')

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto; padding: 20px;">
    <h2>Comunidad Kuroko - Conecta con otros fans</h2>

    @if(session('success'))
        <div style="margin-bottom: 20px; color: green; font-weight: bold; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 20px; text-align: center;">
        <a href="{{ route('comunidad.create') }}" style="padding: 12px 20px; background-color: #2563eb; color: #fff; text-decoration: none; border-radius: 5px; display: inline-block;">Crear mi perfil de contacto</a>
    </div>

    <p style="text-align: center; margin-bottom: 20px; color: #666;">Explora los perfiles de otros fans y conecta con ellos compartiendo tu pasión por Kuroko no Basket.</p>

    @if($contactos->count() > 0)
        <div style="overflow-x: auto;">
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #f2f2f2; color: #333;">
                        <th>Nombre</th>
                        <th>Edad</th>
                        <th>Personaje favorito</th>
                        <th>Equipo favorito</th>
                        <th>Correo</th>
                        <th>Mensaje</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contactos as $contacto)
                        <tr>
                            <td><strong>{{ $contacto->nombre }}</strong></td>
                            <td>{{ $contacto->edad }}</td>
                            <td>{{ $contacto->personaje_favorito }}</td>
                            <td>{{ $contacto->equipo_favorito }}</td>
                            <td><span style="background-color: #e3f2fd; padding: 3px 8px; border-radius: 3px;">{{ $contacto->correo }}</span></td>
                            <td>{{ Str::limit($contacto->mensaje, 60) }}</td>
                            <td><a href="{{ route('comunidad.show', $contacto) }}" style="color: #2563eb; text-decoration: none; font-weight: bold;">Ver perfil →</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div style="margin-top: 30px;">
            {{ $contactos->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 40px; background-color: #f0f0f0; border-radius: 8px;">
            <p style="font-size: 16px; color: #666;">Aún no hay perfiles de contacto. ¡Sé el primero en crear uno!</p>
            <a href="{{ route('comunidad.create') }}" style="padding: 10px 20px; background-color: #2563eb; color: #fff; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 15px;">Crear perfil</a>
        </div>
    @endif
</div>
@endsection
