<?php

namespace App\Http\Requests;

use App\Rules\EquipmentSerialNumber;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int    $equipment_type_id
 * @property string $serial_number
 * @property string $description
 */
class EquipmentRequest extends FormRequest
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
            "equipment_type_id" => ["required", "integer", "exists:equipment_type,id"],
            "serial_number"     => ["required", "string", "unique:equipment,serial_number", new EquipmentSerialNumber($this->equipment_type_id)],
            "description"       => ["nullable", "string", "max:10000"],
        ];
    }
}
