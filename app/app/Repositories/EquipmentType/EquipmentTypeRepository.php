<?php

namespace App\Repositories\EquipmentType;

use App\Models\EquipmentType;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class EquipmentTypeRepository extends BaseRepository
{
    /**
     * @throws ValidationException
     */
    public function find(array $fields): Builder
    {
        $this->checkExistsColumns($fields, EquipmentType::getTableName());

        return EquipmentType::query()
            ->where(function ($query) use ($fields) {
                foreach ($fields as $key => $value) {
                    $query->where($key, $value);
                }
            });
    }
}
