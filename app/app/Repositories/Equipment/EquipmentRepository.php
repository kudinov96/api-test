<?php

namespace App\Repositories\Equipment;

use App\Models\Equipment;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;

class EquipmentRepository extends BaseRepository
{
    /**
     * @throws ValidationException
     */
    public function find(array $fields): Builder
    {
        $this->checkExistsColumns($fields, Equipment::getTableName());

        return Equipment::query()
            ->where(function ($query) use ($fields) {
                foreach ($fields as $key => $value) {
                    $query->where($key, $value);
                }
            });
    }
}
