<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $name
 * @property string $mask
 *
 * @property string $mask_regex
 */
class EquipmentType extends Model
{
    use HasFactory;

    protected $table = "equipment_type";

    protected $fillable = [
        "name",
        "mask",
    ];

    protected $appends = [
        "mask_regex",
    ];

    public function getMaskRegexAttribute(): string
    {
        $mask_regex = "/^";

        foreach (str_split($this->mask) as $word) {
            switch ($word) {
                case "N":
                    $mask_regex .= "[0-9]";
                    break;
                case "A":
                    $mask_regex .= "[A-Z]";
                    break;
                case "a":
                    $mask_regex .= "[a-z]";
                    break;
                case "X":
                    $mask_regex .= "[A-Z0-9]";
                    break;
                case "Z":
                    $mask_regex .= "[-_@]";
                    break;
            }
        }

        $mask_regex .= "/";

        return $mask_regex;
    }
}
