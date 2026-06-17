<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Solicitante;
use App\Http\Requests\StorePrestamoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function index()
    {
        // Se mantiene 'latest()' o un ordenamiento explícito limpio para evitar conflictos de lectura del editor
        $prestamos = Prestamo::query()->with(['equipo', 'solicitante'])->latest('id')->get();
        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        $equipos = Equipo::whereEstado('Disponible')->get();
        $solicitantes = Solicitante::all();
        return view('prestamos.create', compact('equipos', 'solicitantes'));
    }

    public function store(StorePrestamoRequest $request)
    {
        // Usamos una transacción para asegurar que el préstamo y el cambio de estado ocurran juntos
        DB::transaction(function () use ($request) {
            // 1. Buscar el equipo de forma segura (Arroja 404 si el ID no es válido)
            $equipo = Equipo::findOrFail($request->equipo_id);

            // [Opcional] Doble validación por si dos usuarios intentan tomar el mismo equipo al tiempo
            if ($equipo->estado !== 'Disponible') {
                abort(422, 'El equipo seleccionado ya no está disponible.');
            }

            // 2. Registrar préstamo
            Prestamo::create($request->validated());

            // 3. Transición automática de Estado
            $equipo->update(['estado' => 'Prestado']);
        });

        return redirect()->route('prestamos.index')->with('success', 'Préstamo procesado con éxito.');
    }

    public function devolver(Request $request, Prestamo $prestamo)
    {
        $request->validate(['observaciones_devolucion' => 'nullable|string']);

        // Aseguramos la atomicidad de la devolución
        DB::transaction(function () use ($request, $prestamo) {
            // 1. Registrar devolución real
            $prestamo->update([
                'fecha_devolucion_real' => now(),
                'observaciones_devolucion' => $request->observaciones_devolucion
            ]);

            // 2. Regresar equipo a disponible
            $prestamo->equipo->update(['estado' => 'Disponible']);
        });

        return redirect()->route('prestamos.index')->with('success', 'Equipo devuelto e integrado al inventario.');
    }
}
