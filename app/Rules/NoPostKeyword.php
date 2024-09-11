<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoPostKeyword implements Rule
{
    public function passes($attribute, $value)
    {
        return stripos($value, 'post') === false;
    }

    public function message()
    {
        return 'The :attribute should not contain the word "post".';
    }
}
