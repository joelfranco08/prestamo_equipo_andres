@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('prestamos.index') }}" class="text-white-50 text-decoration-none small">← Volver al Historial</a>
    <h1 class="h3 fw-bold text-white mt-2">Registrar Asignación de Equipo</h1>
</div>

<div class="row">
    <div class="col-lg-8">

        @if ($errors->any())
            <div class="alert alert-danger border-0 mb-4" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; border-radius: 12px;">
                <strong class="d-block mb-1">❌ Revisa los siguientes campos obligatorios:</strong>
                <ul class="mb-0 ps-3 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="glass-card" style="padding: 2rem; background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px;">
            <form action="{{ route('prestamos.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">DISPOSITIVO DISPONIBLE</label>
                    <select name="equipo_id" class="form-select @error('equipo_id') is-invalid @enderror"
                            style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;">
                        <option value="">-- Seleccionar de la lista de Inventario --</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }} ({{ $equipo->codigo }}) - {{ $equipo->marca }}
                            </option>
                        @endforeach
                    </select>
                    @error('equipo_id')
                        <div class="text-danger small mt-1">⚠️ {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">PERSONAL SOLICITANTE</label>
                    <select name="solicitante_id" class="form-select @error('solicitante_id') is-invalid @enderror"
                            style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;">
                        <option value="">-- Buscar Funcionario / Aprendiz --</option>
                        @foreach($solicitantes as $solicitante)
                            <option value="{{ $solicitante->id }}" {{ old('solicitante_id') == $solicitante->id ? 'selected' : '' }}>
                                {{ $solicitante->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('solicitante_id')
                        <div class="text-danger small mt-1">⚠️ {{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">FECHA DE DESPACHO</label>
                        <input type="date" name="fecha_prestamo" value="{{ old('fecha_prestamo', date('Y-m-d')) }}"
                               class="form-control @error('fecha_prestamo') is-invalid @enderror"
                               style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">RETORNO MÁXIMO PROGRAMADO</label>
                        <input type="date" name="fecha_devolucion_esperada" value="{{ old('fecha_devolucion_esperada') }}"
                               class="form-control @error('fecha_devolucion_esperada') is-invalid @enderror"
                               style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">CONDICIONES GENERALES Y ENTREGA (OPCIONAL)</label>
                    <textarea name="observaciones_entrega" rows="3" class="form-control text-white"
                              placeholder="Escribe detalles del estado del hardware (ej. Cargador, rayones, estuche)..."
                              style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;">{{ old('observaciones_entrega') }}</textarea>
                </div>

                <button type="submit" class="btn btn-info w-100 fw-bold py-3 text-dark mt-2"
                        style="border-radius: 14px; background: #38bdf8; border: none; font-size: 1rem; box-shadow: 0 4px 14px rgba(56, 189, 248, 0.3);">
                    Confirmar Transacción e Iniciar Flujo
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="glass-card" style="background: rgba(56, 189, 248, 0.03); border-color: rgba(56, 189, 248, 0.1); padding: 1.5rem; border-radius: 16px;">
            <h5 class="fw-bold text-info mb-3" style="color: #38bdf8 !important;">💡 Sincronización Exitosa</h5>
            <p class="text-white-50 small mb-0">Los nombres de los campos de entrada ahora calzan de forma idéntica con el esquema relacional de tu base de datos y la capa de validación del controlador.</p>
        </div>
    </div>
</div>
@endsection
