<?php

namespace App\Http\Controllers;

use App\Actions\Equipment\CreateEquipments;
use App\Http\Requests\EquipmentRequest;
use App\Http\Resources\EquipmentCollection;
use App\Http\Resources\EquipmentResource;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function find(Request $request)
    {

    }

    public function read(int $id, Request $request)
    {

    }

    public function create(EquipmentRequest $request, CreateEquipments $action)
    {
        $items = $action->handle($request);

        return EquipmentResource::collection($items);
    }

    public function update(int $id, EquipmentRequest $request)
    {

    }

    public function delete(int $id)
    {

    }
}
