<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
