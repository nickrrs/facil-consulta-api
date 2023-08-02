<?php

namespace App\Validators\MedicoPaciente;

class MedicoPacienteValidator
{
    public const ERROR_MESSAGES = [
        'required'       => 'O campo :attribute é obrigatório',
        'numeric'        => 'O valor do campo deve ser numérico',
        'max'            => 'O :attribute deve ter no máximo :max caracteres',
        'min'            => 'O :attribute deve ter no mínimo :min caracteres',
        'email'          => 'O campo :attribute deve conter um e-mail válido',
        'password'       => 'O campo :attribute é obrigatório',
        'string'        => 'O campo :attribute deve ser do tipo String',
        'boolean'       => 'O campo :attribute deve ser do tipo Boolean',
        'integer'       => 'O campo ::atribute deve ser do tipo Inteiro'
    ];

    public const NEW_PACKAGE_RULE = [
        'medico_id' => 'required|integer',
        'paciente_id' => 'required|integer',
    ];

}
