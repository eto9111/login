@extends('layouts.layout')

@section('content')
<div class="container" style="padding: 20px;">
    <h2>Tabla de Fans Registrados</h2>

    @if(session('success'))
        <div style="margin-bottom: 20px; color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    @if(isset($fans) && $fans->count() > 0)
        <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f2f2f2; color: #333;">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Edad</th>
                    <th>Personaje</th>
                    <th>Equipo</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fans as $fan)
                <tr>
                    <td>{{ $fan->id }}</td>
                    <td>{{ $fan->nombre }}</td>
                    <td>{{ $fan->correo }}</td>
                    <td>{{ $fan->edad }}</td>
                    <td>{{ $fan->personaje_favorito }}</td>
                    <td>{{ $fan->equipo_favorito }}</td>
                    <td>{{ $fan->motivo }}</td>
                    <td>
                        <a href="{{ route('fans.edit', $fan) }}" style="margin-right: 8px; color: #2563eb;">Editar</a>
                        <form action="{{ route('fans.destroy', $fan) }}" method="POST" style="display: inline;">
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
        <p>Aún no hay fans registrados en la base de datos.</p>
    @endif
</div>
@endsection
