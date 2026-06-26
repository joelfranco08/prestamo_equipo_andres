@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('equipos.index') }}" class="text-white-50 text-decoration-none small">← Volver al Inventario</a>
    <h1 class="h3 fw-bold text-white mt-2">✏️ Editar Equipo: {{ $equipo->nombre }}</h1>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="glass-card" style="padding: 2rem; background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px;">
            <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">CÓDIGO DEL EQUIPO</label>
                        <input type="text" name="codigo" value="{{ old('codigo', $equipo->codigo) }}"
                               class="form-control @error('codigo') is-invalid @enderror"
                               placeholder="Ej. LAN-001"
                               style="background-color: #1f293d; color: #fff; border: 1px solid {{ $errors->has('codigo') ? '#ef4444' : 'rgba(255,255,255,0.15)' }}; border-radius: 12px; padding: 0.75rem;">
                        @error('codigo')
                            <div class="text-danger small mt-1 fw-semibold">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">NOMBRE / ELEMENTO</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $equipo->nombre) }}"
                               class="form-control @error('nombre') is-invalid @enderror"
                               placeholder="Ej. Portátil Core i7"
                               style="background-color: #1f293d; color: #fff; border: 1px solid {{ $errors->has('nombre') ? '#ef4444' : 'rgba(255,255,255,0.15)' }}; border-radius: 12px; padding: 0.75rem;">
                        @error('nombre')
                            <div class="text-danger small mt-1 fw-semibold">⚠️ {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">CATEGORÍA</label>
                        <select name="categoria" class="form-select @error('categoria') is-invalid @enderror"
                                style="background-color: #1f293d; color: #fff; border: 1px solid {{ $errors->has('categoria') ? '#ef4444' : 'rgba(255,255,255,0.15)' }}; border-radius: 12px; padding: 0.75rem;">
                            <option value="" style="background-color: #1f293d;">Seleccione una categoría...</option>
                            <option value="Portátiles" {{ old('categoria', $equipo->categoria) == 'Portátiles' ? 'selected' : '' }}>Portátiles</option>
                            <option value="Videobeams" {{ old('categoria', $equipo->categoria) == 'Videobeams' ? 'selected' : '' }}>Videobeams</option>
                            <option value="Cámaras" {{ old('categoria', $equipo->categoria) == 'Cámaras' ? 'selected' : '' }}>Cámaras</option>
                            <option value="Tablets" {{ old('categoria', $equipo->categoria) == 'Tablets' ? 'selected' : '' }}>Tablets</option>
                        </select>
                        @error('categoria')
                            <div class="text-danger small mt-1 fw-semibold">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">MARCA</label>
                        <select name="marca" class="form-select @error('marca') is-invalid @enderror"
                                style="background-color: #1f293d; color: #fff; border: 1px solid {{ $errors->has('marca') ? '#ef4444' : 'rgba(255,255,255,0.15)' }}; border-radius: 12px; padding: 0.75rem;">
                            <option value="" style="background-color: #1f293d;">Seleccione una marca...</option>
                            <optgroup label="Cómputo y Tablets" style="background-color: #1f293d; color: #38bdf8;">
                                <option value="HP" {{ old('marca', $equipo->marca) == 'HP' ? 'selected' : '' }}>HP</option>
                                <option value="Dell" {{ old('marca', $equipo->marca) == 'Dell' ? 'selected' : '' }}>Dell</option>
                                <option value="Lenovo" {{ old('marca', $equipo->marca) == 'Lenovo' ? 'selected' : '' }}>Lenovo</option>
                                <option value="Asus" {{ old('marca', $equipo->marca) == 'Asus' ? 'selected' : '' }}>Asus</option>
                                <option value="Apple" {{ old('marca', $equipo->marca) == 'Apple' ? 'selected' : '' }}>Apple</option>
                                <option value="Acer" {{ old('marca', $equipo->marca) == 'Acer' ? 'selected' : '' }}>Acer</option>
                                <option value="Samsung" {{ old('marca', $equipo->marca) == 'Samsung' ? 'selected' : '' }}>Samsung</option>
                            </optgroup>
                            <optgroup label="Imagen y Proyección (Videobeams)" style="background-color: #1f293d; color: #38bdf8;">
                                <option value="Epson" {{ old('marca', $equipo->marca) == 'Epson' ? 'selected' : '' }}>Epson</option>
                                <option value="Sony" {{ old('marca', $equipo->marca) == 'Sony' ? 'selected' : '' }}>Sony</option>
                                <option value="BenQ" {{ old('marca', $equipo->marca) == 'BenQ' ? 'selected' : '' }}>BenQ</option>
                                <option value="Optoma" {{ old('marca', $equipo->marca) == 'Optoma' ? 'selected' : '' }}>Optoma</option>
                                <option value="Canon" {{ old('marca', $equipo->marca) == 'Canon' ? 'selected' : '' }}>Canon</option>
                                <option value="Logitech" {{ old('marca', $equipo->marca) == 'Logitech' ? 'selected' : '' }}>Logitech</option>
                            </optgroup>
                            <optgroup label="Otros" style="background-color: #1f293d; color: #38bdf8;">
                                <option value="Genérico" {{ old('marca', $equipo->marca) == 'Genérico' ? 'selected' : '' }}>Genérico / Otra</option>
                            </optgroup>
                        </select>
                        @error('marca')
                            <div class="text-danger small mt-1 fw-semibold">⚠️ {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">ESTADO DEL EQUIPO</label>
                    <select name="estado" class="form-select @error('estado') is-invalid @enderror"
                            style="background-color: #1f293d; color: #fff; border: 1px solid {{ $errors->has('estado') ? '#ef4444' : 'rgba(255,255,255,0.15)' }}; border-radius: 12px; padding: 0.75rem;">
                        <option value="Disponible" {{ old('estado', $equipo->estado) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="Prestado" {{ old('estado', $equipo->estado) == 'Prestado' ? 'selected' : '' }}>Prestado</option>
                        <option value="Mantenimiento" {{ old('estado', $equipo->estado) == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                    </select>
                    @error('estado')
                        <div class="text-danger small mt-1 fw-semibold">⚠️ {{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-info w-100 fw-bold py-3 text-dark mt-2"
                        style="border-radius: 14px; background: #38bdf8; border: none; font-size: 1rem; letter-spacing: 0.5px; box-shadow: 0 4px 14px rgba(56, 189, 248, 0.3);">
                    Actualizar Información del Equipo
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="glass-card" style="background: rgba(56, 189, 248, 0.03); border-color: rgba(56, 189, 248, 0.1); padding: 1.5rem; border-radius: 16px;">
            <h5 class="fw-bold text-info mb-3" style="color: #38bdf8 !important;">📝 Modo Edición</h5>
            <p class="text-white-50 small mb-2">Estás modificando un registro existente en la base de datos.</p>
            <p class="text-white-50 small mb-0">Si cambias el **Estado** a *Mantenimiento*, el sistema restringirá de forma automática que este equipo pueda ser asignado a un nuevo flujo de préstamo hasta que sea liberado.</p>
        </div>
    </div>
</div>
@endsection
