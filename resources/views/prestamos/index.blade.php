@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-dark font-weight-bold">📋 Historial de Préstamos</h2>
    <a href="{{ route('prestamos.create') }}" class="btn btn-primary">+ Registrar Préstamo</a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Equipo</th>
                    <th>Solicitante</th>
                    <th>Fecha Préstamo</th>
                    <th>Devolución Esperada</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestamos as $prestamo)
                    <tr>
                        <td>
                            <strong>{{ $prestamo->equipo->codigo }}</strong> - {{ $prestamo->equipo->nombre }}
                        </td>
                        <td>{{ $prestamo->solicitante->nombre }} ({{ $prestamo->solicitante->tipo }})</td>
                        <td>{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($prestamo->fecha_dev_esperada)->format('d/m/Y') }}</td>
                        <td>
                            @if($prestamo->fecha_devolucion_real)
                                <span class="badge bg-success">Devuelto</span>
                            @else
                                <span class="badge bg-warning text-dark">Activo</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!$prestamo->fecha_devolucion_real)
                                <form action="{{ route('prestamos.devolver', $prestamo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success">Recibir</button>
                                </form>
                            @else
                                <span class="text-muted">Finalizado</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No hay préstamos activos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
