<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\EquipmentType;
use Tests\FeatureTestCase;

class EquipmentTest extends FeatureTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->beUser();
    }

    public function test_create()
    {
        $equipmentType = $this->createEquipmentType();

        $payload = [
            "equipments" => [
                [
                    "equipment_type_id" => $equipmentType->id,
                    "serial_number"     => "g4-H4EMvZF",
                    "description"       => $this->faker->sentence(10),
                ],
                [
                    "equipment_type_id" => $equipmentType->id,
                    "serial_number"     => "z4-H4IMvZF",
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

    public function test_create_validate_serial_number()
    {
        $equipmentType = $this->createEquipmentType();

        $payload = [
            "equipments" => [
                [
                    "equipment_type_id" => $equipmentType->id,
                    "serial_number"     => "1g5-H4EMvZF",
                    "description"       => $this->faker->sentence(10),
                ],
            ]
        ];

        $response = $this->postJson("/api/equipment", $payload);

        $response->assertJsonFragment(["message" => "The given data was invalid."]);
    }

    public function test_update()
    {
        list($equipment) = $this->createEquipment();
        $equipmentType   = $this->createEquipmentType();

        $payload = [
            "equipment_type_id" => $equipmentType->id,
            "serial_number"     => "g4-H4HMvZM",
            "description"       => $this->faker->sentence(10),
        ];

        $this->putJson("/api/equipment/{$equipment->id}", $payload);

        $item = $this->stateBySerialNumber($payload["serial_number"]);

        $this->assertEquals($item->equipment_type_id, $payload["equipment_type_id"]);
        $this->assertEquals($item->serial_number,     $payload["serial_number"]);
        $this->assertEquals($item->description,       $payload["description"]);
    }

    public function test_delete()
    {
        list($equipment) = $this->createEquipment();

        $this->deleteJson("/api/equipment/{$equipment->id}");

        $item = $this->stateBySerialNumber($equipment->serial_number);

        $this->assertNull($item);
    }

    public function test_read()
    {
        list($equipment) = $this->createEquipment();

        $response = $this->getJson("/api/equipment/{$equipment->id}");
        $response->assertJsonFragment(["serial_number" => $equipment->serial_number]);
    }

    public function test_find()
    {
        list($equipment) = $this->createEquipment();

        $response = $this->getJson("/api/equipment");
        $response->assertJsonFragment(["serial_number" => $equipment->serial_number]);
    }

    public function test_find_by_id()
    {
        list($equipment) = $this->createEquipment();

        $response = $this->getJson("/api/equipment?id={$equipment->id}");
        $response->assertJsonFragment(["serial_number" => $equipment->serial_number]);
    }

    public function test_find_by_equipment_type_id()
    {
        list($equipment) = $this->createEquipment();

        $response = $this->getJson("/api/equipment?equipment_type_id={$equipment->equipment_type_id}");
        $response->assertJsonFragment(["serial_number" => $equipment->serial_number]);
    }

    public function test_find_by_serial_number()
    {
        list($equipment) = $this->createEquipment();

        $response = $this->getJson("/api/equipment?serial_number={$equipment->serial_number}");
        $response->assertJsonFragment(["serial_number" => $equipment->serial_number]);
    }

    public function test_find_by_description()
    {
        list($equipment) = $this->createEquipment();

        $response = $this->getJson("/api/equipment?description={$equipment->description}");
        $response->assertJsonFragment(["serial_number" => $equipment->serial_number]);
    }

    private function createEquipmentType(): EquipmentType
    {
        return EquipmentType::factory([
            "mask" => "aNZXXXXaAA",
        ])->create();
    }

    private function createEquipment(): array
    {
        $equipmentType = $this->createEquipmentType();

        $payload = [
            "equipments" => [
                [
                    "equipment_type_id" => $equipmentType->id,
                    "serial_number"     => "g4-H4EMvZF",
                    "description"       => $this->faker->sentence(10),
                ],
                [
                    "equipment_type_id" => $equipmentType->id,
                    "serial_number"     => "z4-H4IMvZF",
                    "description"       => $this->faker->sentence(10),
                ]
            ]
        ];

        $this->postJson("/api/equipment", $payload);

        $equipment = $this->stateBySerialNumber($payload["equipments"][0]["serial_number"]);
        $equipment2 = $this->stateBySerialNumber($payload["equipments"][0]["serial_number"]);

        return [
            $equipment,
            $equipment2,
        ];
    }

    private function stateBySerialNumber(string $serial_number): null | Equipment
    {
        return Equipment::where("serial_number", $serial_number)->first();
    }
}
