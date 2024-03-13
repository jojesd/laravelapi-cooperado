<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TelefoneValidationRule implements Rule
{
    public function passes($attribute, $value)
    {
        // regex para validar telefone com ou sem () e com ou sem - e com 8 ou 9 digitos
        return preg_match("/^(\()?([0-9]{2})(\))?\s?([0-9]{4,5})(\-?)([0-9]{4})$/", $value);
        
    }
    public function message()
    {
        return 'O campo :attribute deve ser um número de telefone válido.';
    }
}
