<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validación compartida por OrganizationController@store y @update.
 */
class OrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // el acceso ya lo controla el middleware auth de las rutas
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'type'          => 'required|string|max:100',
            'phone'         => 'required|string|max:30',
            // al editar, ignora el correo de la propia organización (en store la ruta no la trae y vale null)
            'email'         => ['required', 'email', 'max:255', Rule::unique('organizations', 'email')->ignore($this->route('organization'))],
            'address'       => 'required|string|max:255',
            'city'          => 'required|string|max:100',
            'creation_date' => 'required|date',
            'description'   => 'nullable|string',
        ];
    }

    /**
     * Nombres en español para los mensajes de error.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name'          => 'nombre',
            'type'          => 'tipo',
            'phone'         => 'teléfono',
            'email'         => 'correo',
            'address'       => 'dirección',
            'city'          => 'ciudad',
            'creation_date' => 'fecha de creación',
            'description'   => 'descripción',
        ];
    }
}
