@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="h2 fw-bold text-white mb-1">Historial de Préstamos</h1>
        <p class="text-muted mb-0">Control de flujo e ingresos de hardware activo.</p>
    </div>
    <a href="{{ route('prestamos.create') }}" class="btn fw-semibold px-4 py-2 text-dark shadow" style="border-radius: 12px; background: #38bdf8;">
        ⚡ Registrar Préstamo
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 text-white mb-4 shadow" style="background: rgba(16, 185, 129, 0.2); border-radius: 14px; backdrop-filter: blur(10px);">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger border-0 text-white mb-4 shadow" style="background: rgba(239, 68, 68, 0.2); border-radius: 14px;">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="glass-card">
    <div class="table-responsive">
       <table class="table table-dark table-borderless align-middle mb-0" style="background: transparent !important; --bs-table-bg: transparent !important; color: #f8fafc;">
            <thead>
                <tr style="border-bottom: 2px solid rgba(255, 255, 255, 0.12);">
                    <th class="pb-3" style="font-size: 0.85rem; uppercase; letter-spacing: 0.5px; color: #38bdf8;">EQUIPO</th>
                    <th class="pb-3" style="font-size: 0.85rem; uppercase; letter-spacing: 0.5px; color: #38bdf8;">SOLICITANTE</th>
                    <th class="pb-3" style="font-size: 0.85rem; uppercase; letter-spacing: 0.5px; color: #38bdf8;">FECHA PRÉSTAMO</th>
                    <th class="pb-3" style="font-size: 0.85rem; uppercase; letter-spacing: 0.5px; color: #38bdf8;">DEVOLUCIÓN ESPERADA</th>
                    <th class="pb-3" style="font-size: 0.85rem; uppercase; letter-spacing: 0.5px; color: #38bdf8;">DEVOLUCIÓN REAL</th>
                    <th class="pb-3" style="font-size: 0.85rem; uppercase; letter-spacing: 0.5px; color: #38bdf8;">ESTADO</th>
                    <th class="pb-3 text-center" style="font-size: 0.85rem; uppercase; letter-spacing: 0.5px; color: #38bdf8;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestamos as $prestamo)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.08); background: transparent;">
                        <td class="py-3 text-white">
                            <span class="fw-bold" style="color: #38bdf8;">{{ $prestamo->equipo?->codigo ?? 'S/C' }}</span>
                            <div class="text-muted small">{{ $prestamo->equipo?->nombre ?? 'Equipo Eliminado' }}</div>
                        </td>
                        <td class="py-3 text-white">
                            <div class="fw-semibold text-white">{{ $prestamo->solicitante?->nombre ?? 'N/A' }}</div>
                            <span class="badge bg-dark text-info border border-info mt-1 px-2 py-1" style="font-size: 0.75rem;">
                                {{ $prestamo->solicitante?->tipo ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="py-3 text-white-50">{{ \Carbon\Carbon::parse($prestamo->fecha_prestamo)->format('d/m/Y') }}</td>
                        <td class="py-3 text-white-50">{{ \Carbon\Carbon::parse($prestamo->fecha_devolucion_esperada)->format('d/m/Y') }}</td>

                        <td class="py-3">
                            @if($prestamo->fecha_devolucion_real)
                                @if($prestamo->fecha_devolucion_real < $prestamo->fecha_devolucion_esperada)
                                    <span class="badge px-2 py-1 rounded" style="background: rgba(56, 189, 248, 0.12); color: #38bdf8; border: 1px solid rgba(56, 189, 248, 0.25); font-size: 0.8rem;">
                                        ⚡ Antes: {{ \Carbon\Carbon::parse($prestamo->fecha_devolucion_real)->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="text-white-50">{{ \Carbon\Carbon::parse($prestamo->fecha_devolucion_real)->format('d/m/Y') }}</span>
                                @endif
                            @else
                                <span class="text-muted small" style="font-style: italic;">⏳ Vigente</span>
                            @endif
                        </td>

                        <td class="py-3">
                            @if($prestamo->fecha_devolucion_real)
                                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);">Devuelto</span>
                            @else
                                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3);">Activo</span>
                            @endif
                        </td>
                        <td class="py-3 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                @if(!$prestamo->fecha_devolucion_real)
                                    <form action="{{ route('prestamos.devolver', $prestamo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm fw-bold px-3 py-1.5" style="border-radius: 8px; background: #10b981; color: #fff; border: none; font-size: 0.8rem;">
                                            Recibir
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted small align-self-center">Completado</span>
                                @endif

                                <a href="{{ route('prestamos.pdf', $prestamo->id) }}" target="_blank" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1" style="border-radius: 8px; font-size: 0.8rem;">
                                    📄 PDF
                                </a>
                            </div>
                        </td>
                    </tr>
             @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">No se registran transacciones de hardware en este momento.</td>
                    </tr>
                @endforelse  </tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection
