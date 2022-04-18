<?php

namespace Tests\Feature;

use App\Models\EquipmentType;
use Illuminate\Database\Eloquent\Collection;
use Tests\FeatureTestCase;

class EquipmentTypeTest extends FeatureTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->beUser();
    }

    public function test_find()
    {
        $equipmentType = $this->createEquipmentType();

        $response = $this->getJson("/api/equipment-type");
        $response->assertJsonFragment(["name" => $equipmentType->name]);
    }

    public function test_find_by_id()
    {
        $equipmentType = $this->createEquipmentType();

        $response = $this->getJson("/api/equipment-type?id={$equipmentType->id}");
        $response->assertJsonFragment(["name" => $equipmentType->name]);
    }

    public function test_find_by_name()
    {
        $equipmentType = $this->createEquipmentType();

        $response = $this->getJson("/api/equipment-type?name={$equipmentType->name}");
        $response->assertJsonFragment(["name" => $equipmentType->name]);
    }

    public function test_find_by_mask()
    {
        $equipmentType = $this->createEquipmentType();

        $response = $this->getJson("/api/equipment-type?mask={$equipmentType->mask}");
        $response->assertJsonFragment(["name" => $equipmentType->name]);
    }

    private function createEquipmentType(): EquipmentType | Collection
    {
        return EquipmentType::factory([
            "mask" => "aNZXXXXaAA",
        ])->create();
    }
}
