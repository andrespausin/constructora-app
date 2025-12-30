<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DniNieValidacion implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!$this->isValid($value)) {
            $fail('El DNI/NIE no tiene un formato o letra válida');
        }
    }

    private function isValid($value): bool
    {
        $value = strtoupper(trim($value));
    
        // 1. Verificar formato básico (8 números/letras + 1 letra final)
        if (!preg_match('/^[XYZ0-9][0-9]{7}[A-Z]$/', $value)) {
            return false;
        }

        $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $nieLetras = ['X' => 0, 'Y' => 1, 'Z' => 2];
        $primerCaracter = $value[0];

        // 2. Si es NIE, transformar la letra inicial en número para el cálculo
        if (array_key_exists($primerCaracter, $nieLetras)) {
            $calculo = $nieLetras[$primerCaracter] . substr($value, 1, 7);
        } else {
            $calculo = substr($value, 0, 8);
        }

        $numero = intval($calculo);
        $letraEsperada = $letras[$numero % 23];
        $letraProporcionada = substr($value, -1);

        return $letraEsperada === $letraProporcionada;
    }
}
