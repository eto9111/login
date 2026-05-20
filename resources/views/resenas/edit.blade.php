@extends('layouts.layout')

@section('content')
<div class="container" style="max-width: 700px; margin: 20px auto; padding: 20px;">
    <h2>✏️ Editar opinión</h2>

    @if($errors->any())
        <div style="margin-bottom: 20px; color: #b91c1c; background-color: #fee; padding: 15px; border-radius: 4px;">
            <ul style="margin: 0;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('resenas.update', $resena) }}">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
            <div>
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">⭐ Calificación</label>
                <select name="rating" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $resena->rating) == $i ? 'selected' : '' }}>{{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
                    @endfor
                </select>
            </div>

            <div>
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">🛍️ Producto comprado</label>
                <select name="producto" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                    <option value="Peluche Kuroko" {{ old('producto', $resena->producto) == 'Peluche Kuroko' ? 'selected' : '' }}>Peluche Kuroko</option>
                    <option value="Peluche Kagami" {{ old('producto', $resena->producto) == 'Peluche Kagami' ? 'selected' : '' }}>Peluche Kagami</option>
                    <option value="Balón Seirin" {{ old('producto', $resena->producto) == 'Balón Seirin' ? 'selected' : '' }}>Balón Seirin</option>
                    <option value="Balón Generation of Miracles" {{ old('producto', $resena->producto) == 'Balón Generation of Miracles' ? 'selected' : '' }}>Balón Generation of Miracles</option>
                    <option value="Poster Team Seirin" {{ old('producto', $resena->producto) == 'Poster Team Seirin' ? 'selected' : '' }}>Poster Team Seirin</option>
                    <option value="Poster Generation of Miracles" {{ old('producto', $resena->producto) == 'Poster Generation of Miracles' ? 'selected' : '' }}>Poster Generation of Miracles</option>
                    <option value="Hoodie Seirin" {{ old('producto', $resena->producto) == 'Hoodie Seirin' ? 'selected' : '' }}>Hoodie Seirin</option>
                    <option value="Camiseta Kaijo" {{ old('producto', $resena->producto) == 'Camiseta Kaijo' ? 'selected' : '' }}>Camiseta Kaijo</option>
                    <option value="Tenis Kagami Zone" {{ old('producto', $resena->producto) == 'Tenis Kagami Zone' ? 'selected' : '' }}>Tenis Kagami Zone</option>
                    <option value="Tenis Aomine Street" {{ old('producto', $resena->producto) == 'Tenis Aomine Street' ? 'selected' : '' }}>Tenis Aomine Street</option>
                </select>
            </div>

            <div>
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">📅 Tiempo de llegada</label>
                <select name="tiempo_llegada" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                    <option value="1-3 días" {{ old('tiempo_llegada', $resena->tiempo_llegada) == '1-3 días' ? 'selected' : '' }}>1-3 días</option>
                    <option value="4-7 días" {{ old('tiempo_llegada', $resena->tiempo_llegada) == '4-7 días' ? 'selected' : '' }}>4-7 días</option>
                    <option value="8-14 días" {{ old('tiempo_llegada', $resena->tiempo_llegada) == '8-14 días' ? 'selected' : '' }}>8-14 días</option>
                    <option value="15+ días" {{ old('tiempo_llegada', $resena->tiempo_llegada) == '15+ días' ? 'selected' : '' }}>15+ días</option>
                    <option value="Aún no llega" {{ old('tiempo_llegada', $resena->tiempo_llegada) == 'Aún no llega' ? 'selected' : '' }}>Aún no llega</option>
                </select>
            </div>

            <div>
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">📍 Estado del paquete</label>
                <select name="estado_paquete" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                    <option value="Entregado" {{ old('estado_paquete', $resena->estado_paquete) == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                    <option value="En tránsito" {{ old('estado_paquete', $resena->estado_paquete) == 'En tránsito' ? 'selected' : '' }}>En tránsito</option>
                    <option value="En bodega" {{ old('estado_paquete', $resena->estado_paquete) == 'En bodega' ? 'selected' : '' }}>En bodega</option>
                    <option value="Retrasado" {{ old('estado_paquete', $resena->estado_paquete) == 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
                    <option value="Devuelto" {{ old('estado_paquete', $resena->estado_paquete) == 'Devuelto' ? 'selected' : '' }}>Devuelto</option>
                </select>
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="font-weight: bold; display: block; margin-bottom: 5px;">💬 Tu opinión</label>
            <textarea name="contenido" rows="5" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">{{ old('contenido', $resena->contenido) }}</textarea>
        </div>

        <button type="submit" style="padding: 12px 20px; background-color: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">✓ Actualizar opinión</button>
        <a href="{{ route('dashboard') }}" style="margin-left: 15px; color: #666; text-decoration: none;">Cancelar</a>
    </form>
</div>
@endsection
