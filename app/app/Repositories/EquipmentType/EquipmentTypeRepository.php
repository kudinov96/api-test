<?php

namespace App\Repositories\EquipmentType;

use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Builder;

class EquipmentTypeRepository
{
    public function find(array $fields): Builder
    {
        return EquipmentType::query()
            ->where(function ($query) use ($fields) {
                foreach ($fields as $key => $value) {
                    $query->where($key, $value);
                }
            });
    }
}
