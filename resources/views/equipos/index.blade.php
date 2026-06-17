@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-dark font-weight-bold">🛠️ Gestión de Equipos Tecnológicos</h2>
    <a href="{{ route('equipos.create') }}" class="btn btn-primary">+ Registrar Equipo</a>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('equipos.index') }}" method="GET" class="row g-3">
            <div class="col-md-10">
                <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Buscar por nombre o código del equipo...">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Buscar 🔍</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Marca</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipos as $equipo)
                    <tr>
                        <td><strong>{{ $equipo->codigo }}</strong></td>
                        <td>{{ $equipo->nombre }}</td>
                        <td>{{ $equipo->categoria }}</td>
                        <td>{{ $equipo->marca }}</td>
                        <td>
                            {{-- Modificado usando == y trim() para romper la restricción estricta --}}
                            @if(trim($equipo->estado) == 'Disponible')
                                <span class="badge bg-success">Disponible</span>
                            @elseif(trim($equipo->estado) == 'Prestado')
                                <span class="badge bg-warning text-dark">Prestado</span>
                            @elseif(trim($equipo->estado) == 'Mantenimiento')
                                <span class="badge bg-danger">Mantenimiento</span>
                            @else
                                {{-- En caso de que guarde otra variante, te lo muestra en gris para saber qué llegó --}}
                                <span class="badge bg-secondary">{{ $equipo->estado }}</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-sm btn-info text-white">Editar</a>

                            <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este equipo?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No se encontraron equipos registrados en el sistema.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $equipos->links() }}
</div>
@endsection
