<?php

namespace Database\Factories;

use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $equipmentType = EquipmentType::factory([
            "mask" => "aNZXXXXaAANNN",
        ])->create();

        return [
            "equipment_type_id" => $equipmentType->id,
            "serial_number"     => "g" . rand(0, 9) . "-H" . rand(0, 9) . "EMvZA" . rand(0, 9) . rand(0, 9) . rand(0, 9),
            "description"       => $this->faker->sentence(10),
        ];
    }
}
