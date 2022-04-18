<?php

namespace App\Actions\Equipment;

use App\Models\Equipment;

class DeleteEquipment
{
    public function handle(Equipment $item): void
    {
        $item->delete();
    }
}
