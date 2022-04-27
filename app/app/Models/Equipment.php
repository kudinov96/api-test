<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int    $equipment_type_id
 * @property string $serial_number
 * @property string $description
 */
class Equipment extends Model
{
    use HasFactory;

    protected $table = "equipment";

    protected $fillable = [
        "equipment_type_id",
        "serial_number",
        "description",
    ];

    protected $appends = [
        "equipment_type",
    ];

    public function equipment_type(): HasOne
    {
        return $this->hasOne(EquipmentType::class, "id", "equipment_type_id");
    }

    public function getEquipmentTypeAttribute()
    {
        return $this->equipment_type()->first();
    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }
}
