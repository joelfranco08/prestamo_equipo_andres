@extends('layouts.app')

@section('content')
<div class="card shadow-sm mx-auto" style="max-width: 700px;">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">➕ Registrar Nuevo Equipo</h5>
        <a href="{{ route('equipos.index') }}" class="btn btn-light btn-sm">Volver</a>
    </div>
    <div class="card-body">
        <form action="{{ route('equipos.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Código del Equipo</label>
                    <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control @error('codigo') is-invalid @enderror">
                    @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Nombre / Elemento</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="form-control @error('nombre') is-invalid @enderror">
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Categoría</label>
                    <select name="categoria" class="form-select @error('categoria') is-invalid @enderror">
                        <option value="" selected disabled>Seleccione una categoría...</option>
                        <option value="Portátiles" {{ old('categoria') == 'Portátiles' ? 'selected' : '' }}>Portátiles</option>
                        <option value="Videobeams" {{ old('categoria') == 'Videobeams' ? 'selected' : '' }}>Videobeams</option>
                        <option value="Cámaras" {{ old('categoria') == 'Cámaras' ? 'selected' : '' }}>Cámaras</option>
                        <option value="Tablets" {{ old('categoria') == 'Tablets' ? 'selected' : '' }}>Tablets</option>
                    </select>
                    @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Marca</label>
                    <input type="text" name="marca" value="{{ old('marca') }}" class="form-control @error('marca') is-invalid @enderror">
                    @error('marca') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label font-weight-bold">Estado Inicial</label>
                <select name="estado" class="form-select @error('estado') is-invalid @enderror">
                    <option value="Disponible" {{ old('estado', 'Disponible') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="Prestado" {{ old('estado') == 'Prestado' ? 'selected' : '' }}>Prestado</option>
                    <option value="Mantenimiento" {{ old('estado') == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                </select>
                @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <hr>

            <button type="submit" class="btn btn-success w-100">Guardar Equipo en Sistema</button>
        </form>
    </div>
</div>
@endsection
