<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EquipmentSerialNumber implements Rule
{
    private int $equipment_type_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $equipment_type_id)
    {
        $this->equipment_type_id = $equipment_type_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value): bool
    {
        dd($this->equipment_type_id);
        return preg_match();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return ':attribute error message';
    }
}
