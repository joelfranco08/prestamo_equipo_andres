<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // ⚠️ Asegúrate de cambiar esto a true para que te permita usarlo
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Obtenemos el equipo que viene desde la ruta de manera segura
        $equipo = $this->route('equipo');

        // Si por alguna razón pasa como ID (string/int), extraemos el valor
        $equipoId = is_object($equipo) ? $equipo->id : $equipo;

        return [
            'codigo' => [
                'required',
                'string',
                Rule::unique('equipos', 'codigo')->ignore($equipoId),
            ],
            'nombre'    => 'required|string|max:100',
            'categoria' => 'required|string',
            'marca'     => 'required|string',
            'estado'    => 'required|in:Disponible,Prestado,Mantenimiento',
        ];
    }
}
