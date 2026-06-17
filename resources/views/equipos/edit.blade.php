@extends('layouts.app')

@section('content')
<div class="card shadow-sm mx-auto" style="max-width: 700px;">
    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">✏️ Editar Equipo: {{ $equipo->nombre }}</h5>
        <a href="{{ route('equipos.index') }}" class="btn btn-light btn-sm">Volver</a>
    </div>
    <div class="card-body">
        <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Código del Equipo</label>
                    <input type="text" name="codigo" value="{{ old('codigo', $equipo->codigo) }}" class="form-control @error('codigo') is-invalid @enderror">
                    @error('codigo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Nombre / Elemento</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $equipo->nombre) }}" class="form-control @error('nombre') is-invalid @enderror">
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Categoría</label>
                    <select name="categoria" class="form-select @error('categoria') is-invalid @enderror">
                        <option value="Portátiles" {{ old('categoria', $equipo->categoria) == 'Portátiles' ? 'selected' : '' }}>Portátiles</option>
                        <option value="Videobeams" {{ old('categoria', $equipo->categoria) == 'Videobeams' ? 'selected' : '' }}>Videobeams</option>
                        <option value="Cámaras" {{ old('categoria', $equipo->categoria) == 'Cámaras' ? 'selected' : '' }}>Cámaras</option>
                        <option value="Tablets" {{ old('categoria', $equipo->categoria) == 'Tablets' ? 'selected' : '' }}>Tablets</option>
                    </select>
                    @error('categoria') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold">Marca</label>
                    <input type="text" name="marca" value="{{ old('marca', $equipo->marca) }}" class="form-control @error('marca') is-invalid @enderror">
                    @error('marca') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label font-weight-bold">Estado del Equipo</label>
                <select name="estado" class="form-select @error('estado') is-invalid @enderror">
                    <option value="Disponible" {{ old('estado', $equipo->estado) == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="Prestado" {{ old('estado', $equipo->estado) == 'Prestado' ? 'selected' : '' }}>Prestado</option>
                    <option value="Mantenimiento" {{ old('estado', $equipo->estado) == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                </select>
                @error('estado')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <button type="submit" class="btn btn-primary w-100">Actualizar Información del Equipo</button>
        </form>
    </div>
</div>
@endsection
