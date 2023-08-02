<?php

namespace App\Validators\Paciente;

class PacienteValidator
{
    public const ERROR_MESSAGES = [
        'required'       => 'O campo :attribute é obrigatório',
        'unique'         => 'O campo :attribute já possui este valor cadastrado.',
        'numeric'        => 'O valor do campo deve ser numérico',
        'max'            => 'O :attribute deve ter no máximo :max caracteres',
        'min'            => 'O :attribute deve ter no mínimo :min caracteres',
        'email'          => 'O campo :attribute deve conter um e-mail válido',
        'password'       => 'O campo :attribute é obrigatório',
        'string'        => 'O campo :attribute deve ser do tipo String',
        'boolean'       => 'O campo :attribute deve ser do tipo Boolean',
        'integer'       => 'O campo ::atribute deve ser do tipo Inteiro',
        
    ];

    public const NEW_PACKAGE_RULE = [
        'nome' => 'required|string',
        'cpf' => 'required|string|unique:paciente',
        'celular' => 'required|string',
    ];

    public const UPDATE_PACKAGE_RULE = [
        'nome' => 'string',
        'cpf' => 'string|unique:paciente',
        'celular' => 'string',
    ];
}
