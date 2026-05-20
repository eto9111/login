@extends('layouts.layout')

@section('content')
<div class="container" style="max-width: 700px; margin: 20px auto; padding: 20px;">
    <a href="{{ route('comunidad.index') }}" style="color: #2563eb; text-decoration: none;">← Volver a la comunidad</a>

    <div style="background-color: #f9f9f9; padding: 30px; border-radius: 8px; margin-top: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0; color: #2563eb;">{{ $contacto->nombre }}</h2>

        <div style="background-color: #fff; padding: 20px; border-radius: 6px; margin-bottom: 20px;">
            <div style="margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <p style="margin: 0;"><strong>Edad:</strong> {{ $contacto->edad }}</p>
                <p style="margin: 0;"><strong>Personaje favorito:</strong> {{ $contacto->personaje_favorito }}</p>
                <p style="margin: 0;"><strong>Equipo favorito:</strong> {{ $contacto->equipo_favorito }}</p>
            </div>

            <div style="margin-bottom: 20px; padding: 15px; background-color: #f0f7ff; border-left: 4px solid #2563eb; border-radius: 4px;">
                <p><strong>Sobre este fan:</strong></p>
                <p>{{ $contacto->mensaje }}</p>
            </div>

            <div style="padding: 15px; background-color: #fff3cd; border-radius: 4px; margin-bottom: 20px;">
                <p style="margin: 0;"><strong>Contacto:</strong></p>
                <p style="margin: 5px 0 0 0; font-size: 16px; color: #2563eb;"><a href="mailto:{{ $contacto->correo }}" style="text-decoration: none; color: #2563eb;">{{ $contacto->correo }}</a></p>
                <p style="margin: 5px 0 0 0; font-size: 12px; color: #666;">Publicado: {{ $contacto->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div style="text-align: center;">
                <a href="mailto:{{ $contacto->correo }}" style="display: inline-block; padding: 12px 25px; background-color: #22c55e; color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold;">Enviar correo</a>
            </div>
        </div>

        <div style="padding: 15px; background-color: #e8f5e9; border-radius: 4px; text-align: center;">
            <p style="margin: 0; color: #2d5016;">💡 <strong>Consejo:</strong> Puedes hacer clic en el correo o usar el botón arriba para contactar directamente con {{ $contacto->nombre }}.</p>
        </div>
    </div>
</div>
@endsection
