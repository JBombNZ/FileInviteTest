<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TimeBetween implements Rule
{
    protected $start;
    protected $end;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
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
        
        $start = str_replace(':', '', $this->start);
        $end = str_replace(':', '', $this->end);
        
        if ($value >= $start && $value <= $end) {
            return true;
        }
        
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is out of range.';
    }
}
