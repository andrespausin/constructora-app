<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NumeroSeguridadSocialValido implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 1. Normalizar SOLO para validar (no modificar estado)
        $nss = preg_replace('/[\s-]/', '', (string) $value);

        // 2. Debe ser exactamente 12 dígitos
        if (!preg_match('/^\d{12}$/', $nss)) {
            $fail('El número de la Seguridad Social debe tener exactamente 12 dígitos.');
            return;
        }

        // 3. Validar provincia
        $provincia = (int) substr($nss, 0, 2);
        if ($provincia < 1 || $provincia > 52) {
            $fail('El código de provincia del número de Seguridad Social no es válido.');
            return;
        }

        // 4. Validar dígitos de control
        $base = (int) substr($nss, 0, 10);
        $control = (int) substr($nss, 10, 2);

        if (($base % 97) !== $control) {
            $fail('El número de la Seguridad Social no es válido.');
        }
    }

}
