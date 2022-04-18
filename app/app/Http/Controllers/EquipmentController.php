<?php

namespace App\Http\Controllers;

use App\Actions\Equipment\CreateEquipments;
use App\Actions\Equipment\DeleteEquipment;
use App\Actions\Equipment\UpdateEquipment;
use App\Http\Requests\EquipmentRequest;
use App\Http\Requests\EquipmentsRequest;
use App\Http\Resources\Equipment\EquipmentCollection;
use App\Http\Resources\Equipment\EquipmentResource;
use App\Http\Resources\SuccessResource;
use App\Models\Equipment;
use App\Repositories\Equipment\EquipmentRepository;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * @api {get} /api/equipment-type find
     * @apiDescription Find EquipmentType
     * @apiGroup EquipmentType
     * @apiParam {integer} [id] ID
     * @apiParam {string}  [name] Name
     * @apiParam {string}  [mask] Mask
     * @apiSuccessExample {json} Success
        HTTP/1.1 200
        {
            "data": [
                {
                "id": 12,
                "name": "Reprehenderit vero deleniti.",
                "mask": "aNZXXXXaAA"
                }
            ],
            "links": {
                "first": "http:\/\/localhost\/api\/equipment-type?page=1",
                "last": "http:\/\/localhost\/api\/equipment-type?page=1",
                "prev": null,
                "next": null
            },
            "meta": {
                "current_page": 1,
                "from": 1,
                "last_page": 1,
                "links": [
                    {
                        "url": null,
                        "label": "&laquo; Previous",
                        "active": false
                    },
                    {
                        "url": "http:\/\/localhost\/api\/equipment-type?page=1",
                        "label": "1",
                        "active": true
                    },
                    {
                        "url": null,
                        "label": "Next &raquo;",
                        "active": false
                    }
                ],
                "path": "http:\/\/localhost\/api\/equipment-type",
                "per_page": 2,
                "to": 1,
                "total": 1
            }
        }
     */
    public function find(Request $request, EquipmentRepository $repository): EquipmentCollection
    {
        $items = $repository->find($request->all())->paginate(2);

        return new EquipmentCollection($items);
    }

    /**
     * @api {get} /api/equipment/{id} read
     * @apiDescription Read Equipment
     * @apiGroup Equipment
     * @apiSuccessExample {json} Success
        HTTP/1.1 200
        {
            "data": {
                "id": 3,
                "equipment_type_id": 4,
                "serial_number": "g4-H4HMvZM",
                "description": "Asperiores qui aspernatur ut quo architecto inventore eveniet omnis et."
            }
        }
     */
    public function read(int $id)
    {
        $item = $this->stateItem($id);

        return new EquipmentResource($item);
    }

    /**
     * @api {post} /api/equipment create
     * @apiDescription Create Equipment
     * @apiGroup Equipment
     * @apiParam {array}  equipments
     * @apiParam {integer} equipments[]][equipment_type_id] Equipment type ID
     * @apiParam {string} equipments[][serial_number] Serial number
     * @apiParam {string} equipments[][description] Description
     * @apiSuccessExample {json} Success
        HTTP/1.1 200
        {
            "data": [
                {
                    "id": 1,
                    "equipment_type_id": 1,
                    "serial_number": "g4-H4EMvZF",
                    "description": "Dolores molestias dolor suscipit aut non itaque."
                },
                {
                    "id": 2,
                    "equipment_type_id": 1,
                    "serial_number": "z4-H4IMvZF",
                    "description": "Consectetur beatae optio deleniti veritatis minus nulla mollitia et ex."
                }
            ]
        }
     */
    public function create(EquipmentsRequest $request, CreateEquipments $action): EquipmentCollection
    {
        $items = $action->handle($request);

        return new EquipmentCollection($items);
    }

    /**
     * @api {put} /api/equipment/{id} update
     * @apiDescription Update Equipment
     * @apiGroup Equipment
     * @apiParam {integer} equipment_type_id Equipment type ID
     * @apiParam {string}  serial_number Serial number
     * @apiParam {string}  [description] Description
     * @apiSuccessExample {json} Success
        HTTP/1.1 200
        {
            "data": {
                "id": 3,
                "equipment_type_id": 4,
                "serial_number": "g4-H4HMvZM",
                "description": "Asperiores qui aspernatur ut quo architecto inventore eveniet omnis et."
            }
        }
     */
    public function update(int $id, EquipmentRequest $request, UpdateEquipment $action): EquipmentResource
    {
        $item   = $this->stateItem($id);
        $result = $action->handle($item, $request);

        return new EquipmentResource($result);
    }

    /**
     * @api {delete} /api/equipment/{id} delete
     * @apiDescription Delete Equipment
     * @apiGroup Equipment
     * @apiSuccessExample {json} Success
        HTTP/1.1 200
        {
            "data": {
                "success": true
            }
        }
     */
    public function delete(int $id, Request $request, DeleteEquipment $action): SuccessResource
    {
        $item = $this->stateItem($id);

        $action->handle($item);

        return new SuccessResource($request);
    }

    private function stateItem(int $id)
    {
        return Equipment::findOrFail($id);
    }
}
