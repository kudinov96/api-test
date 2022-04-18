<?php

namespace App\Repositories\Equipment;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Builder;

class EquipmentRepository
{
    public function find(array $fields): Builder
    {
        return Equipment::query()
            ->where(function ($query) use ($fields) {
                foreach ($fields as $key => $value) {
                    $query->where($key, $value);
                }
            });
    }
}
