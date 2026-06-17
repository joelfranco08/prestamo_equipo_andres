<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $equipos = Equipo::when($buscar, function ($query, $buscar) {
            return $query->where('nombre', 'LIKE', "%{$buscar}%")
                         ->orWhere('codigo', 'LIKE', "%{$buscar}%");
        })->paginate(10);

        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo'    => 'required|string|unique:equipos,codigo',
            'nombre'    => 'required|string|max:100',
            'categoria' => 'required|string',
            'marca'     => 'required|string',
            'estado'    => 'required|string',
        ]);

        Equipo::create($datos);
        return redirect()->route('equipos.index')->with('success', 'Equipo registrado con éxito.');
    }

    public function edit(string $id)
    {
        $equipo = Equipo::findOrFail($id);
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, string $id)
    {
        $datosValidados = $request->validate([
            'codigo'    => 'required|string|unique:equipos,codigo,' . $id,
            'nombre'    => 'required|string|max:100',
            'categoria' => 'required|string',
            'marca'     => 'required|string',
            'estado'    => 'required|string',
        ]);

        $equipo = Equipo::findOrFail($id);

        $equipo->codigo    = $datosValidados['codigo'];
        $equipo->nombre    = $datosValidados['nombre'];
        $equipo->categoria = $datosValidados['categoria'];
        $equipo->marca     = $datosValidados['marca'];
        $equipo->estado    = $request->input('estado');

        $equipo->save();

        return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo eliminado correctamente.');
    }
}
