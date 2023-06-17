<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = $this->input('id');

        $rules = [
            'nombres'       => ['required'],
            'ap_paterno'    => ['required'],
            'ap_materno'    => ['required'],
            'nr_rut'        => ['required','cl_rut',Rule::unique('users', 'nr_rut')->ignore($userId,'id')],
            'id_externo'    => ['nullable'],
            'email'         => ['required','email',Rule::unique('users', 'email')->ignore($userId,'id')],
            'celular'       => ['required','digits:9'],
            'tp_activo'     => ['required', 'numeric', 'in:0,1'],
            'nr_unidad'     => ['required','exists:unidad,id'],
            'password'      => ['nullable','size:6'],
        ];

            $nrDepto = $this->input('nr_depto');
            if ($nrDepto != '0') 
                {
                    $rules['nr_depto'] = ['exists:depto,id'];
                }


        return $rules;
    }

    public function attributes()
    {
        return [
            'nombres'        => 'Nombres',
            'ap_paterno'     => 'Apellido Paterno',
            'ap_materno'     => 'Apellido Materno',
            'nr_rut'         => 'RUT',
            'id_externo'     => 'ID Externo',
            'email'          => 'Correo Electrónico',
            'celular'        => 'Número de Celular',
            'tp_activo'      => 'Estado',
            'nr_institucion' => 'Número de Institución',
            'nr_depto'       => 'Número de Departamento',
            'nr_unidad'      => 'Número de Unidad',
            'password'       => 'Contraseña',
        ];
    }

    public function messages()
    {
        return [
            'required'  => 'El campo :attribute es obligatorio.',
            'cl_rut'    => 'El campo :attribute no es un RUT válido.',
            'digits'    => 'El campo :attribute debe tener :digits dígitos.',
            'numeric'   => 'El campo :attribute debe ser numérico.',
            'in'        => 'El campo :attribute tiene un valor no válido.',
            'email'     => 'El campo :attribute debe ser una dirección de correo electrónico válida.',
            'exists'    => 'El campo :attribute no existe en la base de datos.',
            'unique'    => 'El campo :attribute ya existe en la base de datos.',
        ];
    }
}
