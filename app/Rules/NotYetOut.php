<?php

namespace App\Rules;

use App\Models\Result;
use Illuminate\Contracts\Validation\Rule;

class NotYetOut implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Result $result)
    {
        $this->result = $result;
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
        return time() < $this->result->getOriginal('out_at');
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This number is already out, cannot be changed.';
    }
}
