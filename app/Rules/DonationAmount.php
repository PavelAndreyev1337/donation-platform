<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DonationAmount implements Rule
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
        $parts = explode(".", $value);
        $partsCount = count($parts);
        return $value >= 0.01
            && ($partsCount == 1 || $partsCount == 2 && strlen($parts[1]) <= 2 && intval($parts[1]) <= 99);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute should be amount of donation.';
    }
}
