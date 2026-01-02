<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NumeroSeguridadSocialValido implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $value = preg_replace('/\s+/', '', $value);

        // Aceptar solo 10 o 12 dígitos
        if (!preg_match('/^\d{10}|\d{12}$/', $value)) {
            $fail('El número de la Seguridad Social debe tener 10 o 12 dígitos.');
            return;
        }

        $provincia = substr($value, 0, 2);

        if (strlen($value) === 10) {
            // NSS antiguo
            $numero = substr($value, 2, 6);
            $numero = str_pad($numero, 8, '0', STR_PAD_LEFT);
            $control = substr($value, 8, 2);
        } else {
            // NSS moderno
            $numero = substr($value, 2, 8);
            $control = substr($value, 10, 2);
        }

        $base = intval($provincia . $numero);
        $controlCalculado = str_pad($base % 97, 2, '0', STR_PAD_LEFT);

        if ($controlCalculado !== $control) {
            $fail('El número de la Seguridad Social no es válido.');
        }
    }
}
