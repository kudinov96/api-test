<?php

namespace App\Http\Requests;

use App\Rules\EquipmentSerialNumber;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property array $equipments
 */
class EquipmentsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "equipments.*.equipment_type_id" => ["required", "integer", "exists:equipment_type,id"],
            "equipments.*.serial_number"     => [
                "required",
                "string",
                "unique:equipment,serial_number",
                "distinct",
                new EquipmentSerialNumber(current($this->equipments)["equipment_type_id"]),
            ],
            "equipments.*.description"       => ["nullable", "string", "max:10000"],
        ];
    }
}
