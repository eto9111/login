@extends('layouts.layout')

@section('content')
<div class="container" style="max-width: 900px; margin: 0 auto; padding: 20px;">
    <div class="card" style="text-align: center; padding: 30px; margin-bottom: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; border-radius: 8px;">
        <img src="https://static.vecteezy.com/system/resources/previews/007/033/146/non_2x/profile-icon-login-head-icon-vector.jpg" alt="Profile Icon" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; border: 3px solid #fff; margin-bottom: 10px;">
        <h2 style="color: #fff; margin: 10px 0;">¡Bienvenido, {{ Auth::user()->name }}!</h2>
        <p style="color: #fff; margin: 0;">Comparte tu experiencia de compra en la tienda de Kuroko</p>

        @if(session('success'))
            <div style="margin-top: 15px; color: #fff; background-color: rgba(34, 197, 94, 0.9); padding: 10px; border-radius: 4px;">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div style="margin-top: 15px; color: #fff; background-color: rgba(220, 38, 38, 0.9); padding: 10px; border-radius: 4px;">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="card" style="padding: 20px; background-color: #f9f9f9; margin-bottom: 30px; border-radius: 8px;">
        <h3 style="margin-top: 0; color: #2563eb;">📦 Publicar opinión de la tienda de Kuroko</h3>

        @if($errors->has('contenido') || $errors->has('rating') || $errors->has('producto') || $errors->has('tiempo_llegada') || $errors->has('estado_paquete'))
            <div style="margin-bottom: 15px; color: #b91c1c;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('resenas.store') }}">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">⭐ Calificación (1-5)</label>
                    <select name="rating" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                        <option value="">Selecciona una calificación</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">🛍️ Producto comprado</label>
                    <select name="producto" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                        <option value="">Selecciona el producto</option>
                        <option value="Peluche Kuroko" {{ old('producto') == 'Peluche Kuroko' ? 'selected' : '' }}>Peluche Kuroko</option>
                        <option value="Peluche Kagami" {{ old('producto') == 'Peluche Kagami' ? 'selected' : '' }}>Peluche Kagami</option>
                        <option value="Balón Seirin" {{ old('producto') == 'Balón Seirin' ? 'selected' : '' }}>Balón Seirin</option>
                        <option value="Balón Generation of Miracles" {{ old('producto') == 'Balón Generation of Miracles' ? 'selected' : '' }}>Balón Generation of Miracles</option>
                        <option value="Poster Team Seirin" {{ old('producto') == 'Poster Team Seirin' ? 'selected' : '' }}>Poster Team Seirin</option>
                        <option value="Poster Generation of Miracles" {{ old('producto') == 'Poster Generation of Miracles' ? 'selected' : '' }}>Poster Generation of Miracles</option>
                        <option value="Hoodie Seirin" {{ old('producto') == 'Hoodie Seirin' ? 'selected' : '' }}>Hoodie Seirin</option>
                        <option value="Camiseta Kaijo" {{ old('producto') == 'Camiseta Kaijo' ? 'selected' : '' }}>Camiseta Kaijo</option>
                        <option value="Tenis Kagami Zone" {{ old('producto') == 'Tenis Kagami Zone' ? 'selected' : '' }}>Tenis Kagami Zone</option>
                        <option value="Tenis Aomine Street" {{ old('producto') == 'Tenis Aomine Street' ? 'selected' : '' }}>Tenis Aomine Street</option>
                    </select>
                </div>

                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">📅 Tiempo de llegada</label>
                    <select name="tiempo_llegada" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                        <option value="">Selecciona tiempo de llegada</option>
                        <option value="1-3 días" {{ old('tiempo_llegada') == '1-3 días' ? 'selected' : '' }}>1-3 días</option>
                        <option value="4-7 días" {{ old('tiempo_llegada') == '4-7 días' ? 'selected' : '' }}>4-7 días</option>
                        <option value="8-14 días" {{ old('tiempo_llegada') == '8-14 días' ? 'selected' : '' }}>8-14 días</option>
                        <option value="15+ días" {{ old('tiempo_llegada') == '15+ días' ? 'selected' : '' }}>15+ días</option>
                        <option value="Aún no llega" {{ old('tiempo_llegada') == 'Aún no llega' ? 'selected' : '' }}>Aún no llega</option>
                    </select>
                </div>

                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">📍 Estado del paquete</label>
                    <select name="estado_paquete" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                        <option value="">Selecciona estado</option>
                        <option value="Entregado" {{ old('estado_paquete') == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                        <option value="En tránsito" {{ old('estado_paquete') == 'En tránsito' ? 'selected' : '' }}>En tránsito</option>
                        <option value="En bodega" {{ old('estado_paquete') == 'En bodega' ? 'selected' : '' }}>En bodega</option>
                        <option value="Retrasado" {{ old('estado_paquete') == 'Retrasado' ? 'selected' : '' }}>Retrasado</option>
                        <option value="Devuelto" {{ old('estado_paquete') == 'Devuelto' ? 'selected' : '' }}>Devuelto</option>
                    </select>
                </div>
            </div>

            <div style="margin-top: 15px; margin-bottom: 15px;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">💬 Tu opinión</label>
                <textarea name="contenido" rows="4" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;" required>{{ old('contenido') }}</textarea>
            </div>

            <div style="text-align: center;">
                <button type="submit" style="padding: 12px 25px; background-color: #2563eb; color: #fff; border: none; cursor: pointer; border-radius: 4px; font-weight: bold;">Publicar opinión</button>
            </div>
        </form>
    </div>

    <div class="card" style="padding: 20px; border-radius: 8px;">
        <h3 style="margin-top: 0; color: #2563eb;">⭐ Opiniones de la comunidad</h3>

        @if(isset($resenas) && $resenas->count() > 0)
            <div style="overflow-x: auto;">
                <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: #f2f2f2; color: #333;">
                            <th>Usuario</th>
                            <th>⭐ Calificación</th>
                            <th>🛍️ Producto</th>
                            <th>📅 Tiempo de llegada</th>
                            <th>📍 Estado</th>
                            <th>💬 Opinión</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resenas as $resena)
                            <tr>
                                <td><strong>{{ $resena->user->name ?? 'Usuario' }}</strong></td>
                                <td style="text-align: center;">{{ $resena->rating }}/5 ⭐</td>
                                <td>{{ $resena->producto }}</td>
                                <td>{{ $resena->tiempo_llegada }}</td>
                                <td><span style="background-color: #e3f2fd; padding: 4px 8px; border-radius: 3px;">{{ $resena->estado_paquete }}</span></td>
                                <td>{{ Str::limit($resena->contenido, 60) }}</td>
                                <td style="font-size: 12px;">{{ $resena->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if(Auth::id() === $resena->user_id)
                                        <a href="{{ route('resenas.edit', $resena) }}" style="margin-right: 8px; color: #2563eb; text-decoration: none;">Editar</a>
                                        <form action="{{ route('resenas.destroy', $resena) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="background: none; border: none; color: #dc2626; cursor: pointer; text-decoration: none;">Eliminar</button>
                                        </form>
                                    @else
                                        <span style="color: #6b7280; font-size: 12px;">Sin permisos</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p style="text-align: center; color: #666;">No hay opiniones aún. ¡Sé el primero en compartir tu experiencia!</p>
        @endif
    </div>
</div>
@endsection
