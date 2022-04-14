<?php

namespace App\Http\Controllers;

use App\Actions\Equipment\CreateEquipment;
use App\Http\Requests\EquipmentRequest;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function find(Request $request)
    {

    }

    public function read(int $id, Request $request)
    {

    }

    public function create(EquipmentRequest $request, CreateEquipment $action)
    {
        $item = $action->handle($request);
        dd($item);
    }

    public function update(int $id, EquipmentRequest $request)
    {

    }

    public function delete(int $id)
    {

    }
}
