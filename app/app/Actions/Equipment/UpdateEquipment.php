<?php

namespace App\Actions\Equipment;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;

class UpdateEquipment
{
    public function handle(Equipment $item, EquipmentRequest $request): Equipment
    {
        $item->equipment_type_id = $request->equipment_type_id;
        $item->serial_number     = $request->serial_number;
        $item->description       = $request->description;

        $item->save();

        return $item;
    }
}
