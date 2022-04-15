<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\EquipmentType;
use Tests\FeatureTestCase;

class EquipmentTest extends FeatureTestCase
{
    public function test_create()
    {
        $equipmentType = EquipmentType::factory()->create();

        $payload = [
            "equipments" => [
                [
                    "equipment_type_id" => $equipmentType->id,
                    "serial_number"     => "123",
                    "description"       => $this->faker->sentence(10),
                ],
                [
                    "equipment_type_id" => $equipmentType->id,
                    "serial_number"     => "1234",
                    "description"       => $this->faker->sentence(10),
                ]
            ]
        ];

       $this->postJson("/api/equipment", $payload);

       $item_1 = $this->stateBySerialNumber($payload["equipments"][0]["serial_number"]);
       $item_2 = $this->stateBySerialNumber($payload["equipments"][1]["serial_number"]);

       $this->assertEquals($item_1->equipment_type_id,  $payload["equipments"][0]["equipment_type_id"]);
       $this->assertEquals($item_1->serial_number,      $payload["equipments"][0]["serial_number"]);
       $this->assertEquals($item_1->description,        $payload["equipments"][0]["description"]);
       $this->assertEquals($item_2->equipment_type_id,  $payload["equipments"][1]["equipment_type_id"]);
       $this->assertEquals($item_2->serial_number,      $payload["equipments"][1]["serial_number"]);
       $this->assertEquals($item_2->description,        $payload["equipments"][1]["description"]);
    }

    private function stateBySerialNumber(string $serial_number): Equipment
    {
        return Equipment::where("serial_number", $serial_number)->first();
    }
}
