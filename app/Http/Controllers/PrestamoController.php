<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Solicitante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    public function index()
    {
        // Trae los préstamos cargando sus relaciones individuales
        $prestamos = Prestamo::with(['equipo', 'solicitante'])->latest('id')->get();

        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        // Solo mandamos a la vista los equipos que estén libres
        $equipos = Equipo::where('estado', 'Disponible')->get();
        $solicitantes = Solicitante::all();

        return view('prestamos.create', compact('equipos', 'solicitantes'));
    }

    public function store(Request $request)
    {
        // Validamos directamente aquí usando los nombres reales del formulario HTML
        $request->validate([
            'equipo_id'                 => 'required|exists:equipos,id',
            'solicitante_id'            => 'required|exists:solicitantes,id',
            'fecha_prestamo'            => 'required|date',
            'fecha_devolucion_esperada' => 'required|date|after_or_equal:fecha_prestamo',
            'observaciones_entrega'     => 'nullable|string|max:500',
        ]);

        DB::transaction(function () use ($request) {
            $equipo = Equipo::findOrFail($request->equipo_id);

            // Insertamos el registro mapeando la base de datos con los inputs reales
            Prestamo::create([
                'equipo_id'                 => $request->input('equipo_id'),
                'solicitante_id'            => $request->input('solicitante_id'),
                'fecha_prestamo'            => $request->input('fecha_prestamo'),
                'fecha_devolucion_esperada' => $request->input('fecha_devolucion_esperada'),
                'observaciones_entrega'     => $request->input('observaciones_entrega'),
            ]);

            // Cambiamos automáticamente el estado del equipo a Prestado
            $equipo->update(['estado' => 'Prestado']);
        });

        return redirect()->route('prestamos.index')->with('success', 'Préstamo procesado con éxito y equipo actualizado.');
    }

    public function devolver(Request $request, $id)
    {
        DB::transaction(function () use ($id) {
            // 1. Buscamos el préstamo activo
            $prestamo = Prestamo::findOrFail($id);

            // 2. Registramos la fecha de devolución real (hoy)
            $prestamo->update([
                'fecha_devolucion_real' => now()->format('Y-m-d'),
            ]);

            // 3. ¡Liberamos el hardware automáticamente!
            $prestamo->equipo->update([
                'estado' => 'Disponible'
            ]);
        });

        return redirect()->route('prestamos.index')->with('success', 'Equipo recibido con éxito. Su estado ha cambiado a Disponible.');
    }
}
