<?php

namespace App\Rules;

use App\Models\EquipmentType;
use Illuminate\Contracts\Validation\Rule;

class EquipmentSerialNumber implements Rule
{
    private EquipmentType $equipment_type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $equipment_type_id)
    {
        $this->equipment_type = EquipmentType::find($equipment_type_id);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     */
    public function passes($attribute, $value): bool
    {
        return (bool) preg_match($this->equipment_type->mask_regex, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return ":attribute must match the mask \"{$this->equipment_type->mask}\"";
    }
}
