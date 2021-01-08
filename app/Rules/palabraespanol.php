<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class palabraespanol implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $r = (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        return empty($r);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El :attribute no puede contener números.';
    }
}
