<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CodigoPostalValido implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        if (!in_array(substr($value, 0, 2), ['29', '14', '18'])) {
            $fail('El código postal debe empezar por 29, 14 o 18.');
        }
  
    }

}

