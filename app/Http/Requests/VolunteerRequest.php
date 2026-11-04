<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Validación compartida por VolunteerController@store y @update.
 */
class VolunteerRequest extends FormRequest
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
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'phone'           => 'required|string|max:30',
            // al editar, ignora el correo del propio voluntario (en store la ruta no lo trae y vale null)
            'email'           => ['required', 'email', 'max:255', Rule::unique('volunteers', 'email')->ignore($this->route('volunteer'))],
            'city'            => 'required|string|max:100',
            'birth_date'      => 'required|date|before:today',
            'image'           => 'nullable|image|max:2048',
            'organizations'   => 'nullable|array',
            'organizations.*' => 'exists:organizations,id',
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
            'first_name'      => 'nombre',
            'last_name'       => 'apellido',
            'phone'           => 'teléfono',
            'email'           => 'correo',
            'city'            => 'ciudad',
            'birth_date'      => 'fecha de nacimiento',
            'image'           => 'foto',
            'organizations'   => 'organizaciones',
            'organizations.*' => 'organización',
        ];
    }
}
