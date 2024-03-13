<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CpfCnpjValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $value);
        
        // Verifique se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifique se todos os dígitos são iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Algoritmo de validação do CPF
        for ($i = 9; $i < 11; $i++) {
            $sum = 0;
            for ($j = 0; $j < $i; $j++) {
                $sum += $cpf[$j] * (($i + 1) - $j);
            }
            $rest = $sum % 11;
            if ($rest < 2) {
                $digit = 0;
            } else {
                $digit = 11 - $rest;
            }
            if ($digit != $cpf[$i]) {
                return false;
            }
        }
        
        return true;
    }

    public function message()
    {
        return 'O campo :attribute deve ser um CPF válido.';
    }
}

