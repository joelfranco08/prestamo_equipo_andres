@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('equipos.index') }}" class="text-white-50 text-decoration-none small">← Volver al Inventario</a>
    <h1 class="h3 fw-bold text-white mt-2">Registrar Nuevo Equipo</h1>
    @if ($errors->any())
    <div class="alert alert-danger border-0 mb-4" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; border-radius: 12px;">
        <strong class="d-block mb-1">❌ El formulario fue rechazado por lo siguiente:</strong>
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="glass-card" style="padding: 2rem; background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px;">
            <form action="{{ route('equipos.store') }}" method="POST">
                @csrf

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">CÓDIGO DEL EQUIPO</label>
                        <input type="text" name="codigo" value="{{ old('codigo') }}"
                               class="form-control @error('codigo') is-invalid @enderror"
                               placeholder="Ej. LAN-001"
                               style="background-color: #1f293d; color: #fff; border: 1px solid {{ $errors->has('codigo') ? '#ef4444' : 'rgba(255,255,255,0.15)' }}; border-radius: 12px; padding: 0.75rem;">
                        @error('codigo')
                            <div class="text-danger small mt-1 fw-semibold">⚠️ {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">NOMBRE / ELEMENTO</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}"
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
                            <option value="Portátiles" {{ old('categoria') == 'Portátiles' ? 'selected' : '' }}>Portátiles</option>
                            <option value="Videobeams" {{ old('categoria') == 'Videobeams' ? 'selected' : '' }}>Videobeams</option>
                            <option value="Cámaras" {{ old('categoria') == 'Cámaras' ? 'selected' : '' }}>Cámaras</option>
                            <option value="Tablets" {{ old('categoria') == 'Tablets' ? 'selected' : '' }}>Tablets</option>
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
                                <option value="HP" {{ old('marca') == 'HP' ? 'selected' : '' }}>HP</option>
                                <option value="Dell" {{ old('marca') == 'Dell' ? 'selected' : '' }}>Dell</option>
                                <option value="Lenovo" {{ old('marca') == 'Lenovo' ? 'selected' : '' }}>Lenovo</option>
                                <option value="Asus" {{ old('marca') == 'Asus' ? 'selected' : '' }}>Asus</option>
                                <option value="Apple" {{ old('marca') == 'Apple' ? 'selected' : '' }}>Apple</option>
                                <option value="Acer" {{ old('marca') == 'Acer' ? 'selected' : '' }}>Acer</option>
                                <option value="Samsung" {{ old('marca') == 'Samsung' ? 'selected' : '' }}>Samsung</option>
                            </optgroup>
                            <optgroup label="Imagen y Proyección (Videobeams)" style="background-color: #1f293d; color: #38bdf8;">
                                <option value="Epson" {{ old('marca') == 'Epson' ? 'selected' : '' }}>Epson</option>
                                <option value="Sony" {{ old('marca') == 'Sony' ? 'selected' : '' }}>Sony</option>
                                <option value="BenQ" {{ old('marca') == 'BenQ' ? 'selected' : '' }}>BenQ</option>
                                <option value="Optoma" {{ old('marca') == 'Optoma' ? 'selected' : '' }}>Optoma</option>
                                <option value="Canon" {{ old('marca') == 'Canon' ? 'selected' : '' }}>Canon</option>
                                <option value="Logitech" {{ old('marca') == 'Logitech' ? 'selected' : '' }}>Logitech</option>
                            </optgroup>
                            <optgroup label="Otros" style="background-color: #1f293d; color: #38bdf8;">
                                <option value="Genérico" {{ old('marca') == 'Genérico' ? 'selected' : '' }}>Genérico / Otra</option>
                            </optgroup>
                        </select>
                        @error('marca')
                            <div class="text-danger small mt-1 fw-semibold">⚠️ {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">ESTADO OPERATIVO INICIAL</label>
                    <select name="estado" class="form-select @error('estado') is-invalid @enderror"
                            style="background-color: #1f293d; color: #fff; border: 1px solid {{ $errors->has('estado') ? '#ef4444' : 'rgba(255,255,255,0.15)' }}; border-radius: 12px; padding: 0.75rem;">
                        <option value="Disponible" {{ old('estado') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                        <option value="Mantenimiento" {{ old('estado') == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                        <option value="Prestado" {{ old('estado') == 'Prestado' ? 'selected' : '' }}>Prestado</option>
                    </select>
                    @error('estado')
                        <div class="text-danger small mt-1 fw-semibold">⚠️ {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">DESCRIPCIÓN Y ESPECIFICACIONES</label>
                    <textarea name="descripcion" rows="4" class="form-control text-white"
                              placeholder="Detalla procesador, RAM, almacenamiento o accesorios incluidos..."
                              style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;">{{ old('descripcion') }}</textarea>
                </div>

                <button type="submit" class="btn btn-info w-100 fw-bold py-3 text-dark mt-2"
                        style="border-radius: 14px; background: #38bdf8; border: none; font-size: 1rem; letter-spacing: 0.5px; box-shadow: 0 4px 14px rgba(56, 189, 248, 0.3);">
                    Guardar Equipo en Sistema
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="glass-card" style="background: rgba(56, 189, 248, 0.03); border-color: rgba(56, 189, 248, 0.1); padding: 1.5rem; border-radius: 16px;">
            <h5 class="fw-bold text-info mb-3" style="color: #38bdf8 !important;">🔒 Validación de Catálogo</h5>
            <p class="text-white-50 small mb-2">Para mantener la integridad de los reportes y las auditorías de hardware, las marcas han sido categorizadas por su nicho tecnológico primario.</p>
            <p class="text-white-50 small mb-0">Recuerda que el **Código del Equipo** debe ser único en la base de datos para evitar colisiones en las trazas de préstamos.</p>
        </div>
    </div>
</div>
@endsection
