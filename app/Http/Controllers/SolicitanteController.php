<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use Illuminate\Http\Request;

class SolicitanteController extends Controller
{
    public function index(Request $request)
    {
        // Buscador por nombre o documento (Query Builder)
        $buscar = $request->get('buscar');

        $solicitantes = Solicitante::when($buscar, function ($query, $buscar) {
            return $query->where('nombre', 'LIKE', "%{$buscar}%")
                         ->orWhere('documento', 'LIKE', "%{$buscar}%");
        })->paginate(10);

        return view('solicitantes.index', compact('solicitantes'));
    }

    public function create()
    {
        return view('solicitantes.create');
    }

    public function store(Request $request)
    {
        // Validamos los datos antes de registrar (actualizado a tus tipos reales del SENA)
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'documento' => 'required|string|unique:solicitantes,documento|max:20',
            'correo'    => 'required|email|unique:solicitantes,correo|max:255',
            'tipo'      => 'required|in:Aprendiz,Docente,Administrativo',
        ]);

        Solicitante::create($request->all());

        return redirect()->route('solicitantes.index')->with('success', 'Solicitante registrado con éxito.');
    }

    /**
     * Muestra el formulario para editar el solicitante.
     */
    public function edit($id)
    {
        $solicitante = Solicitante::findOrFail($id);
        return view('solicitantes.edit', compact('solicitante'));
    }

    /**
     * Actualiza los datos del solicitante en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $solicitante = Solicitante::findOrFail($id);

        $request->validate([
            'nombre'    => 'required|string|max:255',
            'documento' => 'required|string|max:20|unique:solicitantes,documento,' . $solicitante->id,
            'correo'    => 'required|email|max:255|unique:solicitantes,correo,' . $solicitante->id,
            'tipo'      => 'required|in:Aprendiz,Docente,Administrativo',
        ]);

        $solicitante->update($request->all());

        return redirect()->route('solicitantes.index')->with('success', 'Solicitante actualizado con éxito.');
    }

    /**
     * Elimina al solicitante del sistema.
     */
    public function destroy($id)
    {
        $solicitante = Solicitante::findOrFail($id);
        $solicitante->delete();

        return redirect()->route('solicitantes.index')->with('success', 'Solicitante eliminado con éxito.');
    }
}
