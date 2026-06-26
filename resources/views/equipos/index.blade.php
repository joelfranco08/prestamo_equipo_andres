@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h1 class="h2 fw-bold text-white mb-1">Gestión de Equipos Tecnológicos</h1>
        <p class="text-white-50 mb-0">Inventario general, estado y trazabilidad de hardware activo.</p>
    </div>
    <a href="{{ route('equipos.create') }}" class="btn btn-info fw-semibold px-4 py-2 text-dark shadow" style="border-radius: 12px; background: #38bdf8; border: none;">
        ⚡ Registrar Equipo
    </a>
</div>

<div class="glass-card mb-4" style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 1.5rem;">
    <form action="{{ route('equipos.index') }}" method="GET" class="row g-3">
        <div class="col-md-10">
            <input type="text" name="buscar" value="{{ request('buscar') }}"
                   class="form-control text-white" placeholder="Buscar por nombre o código del equipo..."
                   style="background-color: #1f293d65; color: #fff !important; border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 0.75rem;">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-info w-100 fw-bold" style="border-radius: 12px; padding: 0.75rem; border: 1px solid #38bdf8; color: #38bdf8;">
                Buscar 🔍
            </button>
        </div>
    </form>
</div>

<div class="glass-card" style="background: rgba(30, 41, 59, 0.4); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 1.5rem;">
    <div class="table-responsive">
        <table class="table table-dark table-borderless align-middle mb-0" style="background: transparent !important; --bs-table-bg: transparent !important; color: #f8fafc;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                    <th class="text-white-50 pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">CÓDIGO</th>
                    <th class="text-white-50 pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">NOMBRE</th>
                    <th class="text-white-50 pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">CATEGORÍA</th>
                    <th class="text-white-50 pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">MARCA</th>
                    <th class="text-white-50 pb-3" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">ESTADO</th>
                    <th class="text-white-50 pb-3 text-center" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipos as $equipo)
                    <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.04); background: transparent !important; transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                        <td class="py-3">
                            <span class="text-info fw-bold" style="color: #38bdf8 !important;">{{ $equipo->codigo }}</span>
                        </td>
                        <td class="py-3 fw-semibold text-white">{{ $equipo->nombre }}</td>
                        <td class="py-3">
                            <span class="badge" style="background-color: rgba(255,255,255,0.08) !important; color: #cbd5e1 !important; border: 1px solid rgba(255,255,255,0.15); padding: 0.4rem 0.75rem; border-radius: 6px; font-size: 0.8rem;">
                                {{ $equipo->categoria }}
                            </span>
                        </td>
                        <td class="py-3 text-white-50">{{ $equipo->marca }}</td>
                        <td class="py-3">
                            @if(trim($equipo->estado) == 'Disponible')
                                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(16, 185, 129, 0.15); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);">Disponible</span>
                            @elseif(trim($equipo->estado) == 'Prestado')
                                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(245, 158, 11, 0.15); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3);">Prestado</span>
                            @elseif(trim($equipo->estado) == 'Mantenimiento')
                                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);">Mantenimiento</span>
                            @else
                                <span class="badge px-3 py-2 rounded-pill" style="background: rgba(148, 163, 184, 0.15); color: #94a3b8; border: 1px solid rgba(148, 163, 184, 0.3);">{{ $equipo->estado }}</span>
                            @endif
                        </td>
                        <td class="py-3 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-sm btn-outline-info fw-bold px-3" style="border-radius: 8px; font-size: 0.8rem;">
                                    Editar
                                </a>

                                <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="d-inline-block m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm fw-bold px-3" style="border-radius: 8px; background: #ef4444; color: #fff; border: none; font-size: 0.8rem;" onclick="return confirm('¿Seguro que deseas eliminar este equipo?')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-white-50 py-5">No se encontraron equipos registrados en el sistema.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center dark-pagination">
    {{ $equipos->links() }}
</div>
@endsection
