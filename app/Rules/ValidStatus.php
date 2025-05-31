<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Task;

class ValidStatus implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! in_array($value, Task::STATUSES)) {
            $fail('El estado seleccionado no es válido.'); // Mensaje de error
            // O un mensaje más descriptivo:
            // $fail('El estado debe ser uno de los siguientes: ' . implode(', ', Task::STATUSES) . '.');
        }
    }
}
