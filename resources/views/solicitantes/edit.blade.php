@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('solicitantes.index') }}" class="text-white-50 text-decoration-none small">← Volver a la Lista</a>
    <h1 class="h3 fw-bold text-white mt-2">Modificar Datos de Solicitante</h1>
</div>

<div class="row">
    <div class="col-lg-8">

        @if ($errors->any())
            <div class="alert alert-danger border-0 mb-4" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; border-radius: 12px;">
                <strong class="d-block mb-1">❌ Revisa los errores de validación:</strong>
                <ul class="mb-0 ps-3 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="glass-card" style="padding: 2rem; background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px;">
            <form action="{{ route('solicitantes.update', $solicitante->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">DOCUMENTO DE IDENTIDAD / FICHA</label>
                    <input type="text" name="documento" value="{{ old('documento', $solicitante->documento) }}" class="form-control text-white" required
                           style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;"
                           placeholder="Escribe el número de identificación o ficha...">
                </div>

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">NOMBRE COMPLETO</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $solicitante->nombre) }}" class="form-control text-white" required
                           style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;"
                           placeholder="Nombres y apellidos completos...">
                </div>

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">CORREO ELECTRÓNICO</label>
                    <input type="email" name="correo" value="{{ old('correo', $solicitante->correo) }}" class="form-control text-white" required
                           style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;"
                           placeholder="ejemplo@correo.com">
                </div>

                <div class="mb-4">
                    <label class="form-label text-white small fw-bold" style="letter-spacing: 0.5px;">TIPO DE SOLICITANTE</label>
                    <select name="tipo" class="form-select" required
                            style="background-color: #1f293d; color: #fff; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;">
                        <option value="">-- Seleccione Tipo --</option>
                        <option value="Aprendiz" {{ old('tipo', $solicitante->tipo) == 'Aprendiz' ? 'selected' : '' }}>Aprendiz</option>
                        <option value="Docente" {{ old('tipo', $solicitante->tipo) == 'Docente' ? 'selected' : '' }}>Docente</option>
                        <option value="Administrativo" {{ old('tipo', $solicitante->tipo) == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                    </select>
                </div>

                <div class="d-flex gap-3 justify-content-end mt-4">
                    <a href="{{ route('solicitantes.index') }}" class="btn btn-outline-secondary px-4 py-2.5 fw-semibold" style="border-radius: 12px; color: #94a3b8; border-color: rgba(255,255,255,0.1);">
                        Cancelar
                    </a>
                    <button type="submit" class="btn px-4 py-2.5 fw-bold text-dark shadow" style="border-radius: 12px; background: #38bdf8;">
                        Actualizar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
