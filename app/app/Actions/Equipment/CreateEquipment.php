<?php

namespace App\Actions\Equipment;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;

class CreateEquipment
{
    public function handle(EquipmentRequest $request): Equipment
    {
        $item                    = new Equipment();
        $item->equipment_type_id = $request->equipment_type_id;
        $item->serial_number     = $request->serial_number;
        $item->description       = $request->description ?? null;

        $item->save();

        return $item;
    }
}
