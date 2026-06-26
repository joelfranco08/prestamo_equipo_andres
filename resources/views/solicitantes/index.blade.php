@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="h2 fw-bold text-white mb-1">Administración de Solicitantes</h1>
        <p class="text-muted mb-0">Gestión de personal habilitado para la asignación de hardware.</p>
    </div>
    <a href="{{ route('solicitantes.create') }}" class="btn fw-semibold px-4 py-2 text-dark shadow" style="border-radius: 12px; background: #38bdf8;">
        ⚡ Registrar Solicitante
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 text-white mb-4 shadow" style="background: rgba(16, 185, 129, 0.2); border-radius: 14px; backdrop-filter: blur(10px);">
        {{ session('success') }}
    </div>
@endif

<div class="glass-card p-3 mb-4" style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px;">
    <form action="{{ route('solicitantes.index') }}" method="GET" class="row g-2">
        <div class="col-md-10">
            <input type="text" name="buscar" value="{{ request('buscar') }}"
                   class="form-control text-white border-0 py-2.5 px-3"
                   placeholder="Buscar por nombre, documento o ficha del solicitante..."
                   style="background: rgba(15, 23, 42, 0.6); border-radius: 12px; color: #fff;">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-info w-100 py-2.5 fw-semibold" style="border-radius: 12px; border: 1px solid rgba(56, 189, 248, 0.3); color: #38bdf8;">
                Buscar 🔍
            </button>
        </div>
    </form>
</div>

<div class="glass-card" style="background: rgba(30, 41, 59, 0.3); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 1.5rem;">
    <div class="table-responsive">
       <table class="table table-dark table-borderless align-middle mb-0" style="background: transparent !important; --bs-table-bg: transparent !important; color: #f8fafc;">
            <thead>
                <tr style="border-bottom: 2px solid rgba(255, 255, 255, 0.12);">
                    <th class="pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #38bdf8;">DOCUMENTO / FICHA</th>
                    <th class="pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #38bdf8;">NOMBRE COMPLETO</th>
                    <th class="pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #38bdf8;">CORREO ELECTRÓNICO</th>
                    <th class="pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #38bdf8;">TIPO</th>
                    <th class="pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #38bdf8;">FECHA REGISTRO</th>
                    <th class="pb-3 text-center" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; color: #38bdf8;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse($solicitantes as $solicitante)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.08); background: transparent;">
                        <td class="py-3 text-white fw-bold">{{ $solicitante->documento }}</td>
                        <td class="py-3 text-white fw-semibold">{{ $solicitante->nombre }}</td>
                        <td class="py-3 text-white-50">{{ $solicitante->correo }}</td>
                        <td class="py-3">
                            <span class="badge bg-dark text-info border border-info px-2 py-1" style="font-size: 0.75rem; border-radius: 6px;">
                                {{ $solicitante->tipo }}
                            </span>
                        </td>
                        <td class="py-3 text-white-50">
                            {{ $solicitante->created_at ? $solicitante->created_at->format('d/m/Y') : date('d/m/Y') }}
                        </td>
                        <td class="py-3 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('solicitantes.edit', $solicitante->id) }}" class="btn btn-sm btn-outline-info fw-semibold px-3" style="border-radius: 8px; font-size: 0.8rem;">
                                    Editar
                                </a>
                                <form action="{{ route('solicitantes.destroy', $solicitante->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Remover a este solicitante del sistema?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold px-2" style="border-radius: 8px; font-size: 0.8rem;">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">No se encontraron solicitantes en el sistema.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
