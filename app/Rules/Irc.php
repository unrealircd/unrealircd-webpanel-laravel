<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Irc implements Rule
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
     * todo: we need to cover chars from other charsets. this is just basic latin characters.
     *      see https://www.unrealircd.org/docs/Nick_Character_Sets.
     *      We should probably also have "charset" files that we can load rather than use what will be a very
     *      complex regex.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if(preg_match_all("[a-zA-Z0-9\[\]^\-\_\|\{\}]", $value) > 0) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Illegal characters.';
    }
}
