@extends('layouts.layout')

@section('content')
<div class="container" style="padding: 20px;">
    <h2>Listado de Personas</h2>

    @if(session('success'))
        <div style="margin-bottom: 20px; color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 15px;">
        <a href="{{ route('personas.create') }}" style="padding: 10px 15px; background-color: #2563eb; color: #fff; text-decoration: none; border-radius: 5px;">Registrar nueva persona</a>
    </div>

    @if($personas->count() > 0)
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f2f2f2; color: #333;">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                    <th>Correo</th>
                    <th>Celular</th>
                    <th>Personaje favorito</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($personas as $persona)
                <tr>
                    <td>{{ $persona->id }}</td>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->apellido }}</td>
                    <td>{{ $persona->edad }}</td>
                    <td>{{ $persona->correo }}</td>
                    <td>{{ $persona->celular }}</td>
                    <td>{{ $persona->personaje_favorito }}</td>
                    <td>
                        <a href="{{ route('personas.edit', $persona) }}" style="margin-right: 8px; color: #2563eb;">Editar</a>
                        <form action="{{ route('personas.destroy', $persona) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: #dc2626; cursor: pointer;">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aún no hay personas registradas.</p>
    @endif
</div>
@endsection
