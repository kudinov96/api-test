<?php

namespace App\Actions\Equipment;

use App\Http\Requests\EquipmentRequest;
use App\Models\Equipment;
use Illuminate\Support\Collection;

class CreateEquipments
{
    public function handle(EquipmentRequest $request): Collection
    {
        $collection = new Collection();

        foreach ($request->equipments as $equipment) {
            $item                    = new Equipment();
            $item->equipment_type_id = $equipment["equipment_type_id"];
            $item->serial_number     = $equipment["serial_number"];
            $item->description       = $equipment["description"] ?? null;

            $item->save();

            $collection->push($item);
        }

        return $collection;
    }
}
