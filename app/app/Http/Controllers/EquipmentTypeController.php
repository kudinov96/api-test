<?php

namespace App\Http\Controllers;

use App\Http\Resources\EquipmentType\EquipmentTypeCollection;
use App\Repositories\EquipmentType\EquipmentTypeRepository;
use Illuminate\Http\Request;

class EquipmentTypeController extends Controller
{
    /**
     * @api {get} /api/equipment find
     * @apiDescription Find Equipment
     * @apiGroup Equipment
     * @apiParam {integer} [id] ID
     * @apiParam {integer} [equipment_type_id] Equipment type ID
     * @apiParam {string}  [serial_number] Serial number
     * @apiParam {string}  [description] Email
     * @apiSuccessExample {json} Success
        HTTP/1.1 200
        {
            "data": [
                {
                    "id": 12,\n
                    "name": "Aspernatur aut iusto.",\n
                    "mask": "aNZXXXXaAA"
                },
                {
                    "id": 13,\n
                    "name": "Aspernatur aut iusto 2",\n
                    "mask": "aNZXaXXaAA"
                }
            ],
            "links": {
                "first": "http:\/\/localhost\/api\/equipment?page=1",
                "last": "http:\/\/localhost\/api\/equipment?page=1",
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
                        "url": "http:\/\/localhost\/api\/equipment?page=1",
                        "label": "1",
                        "active": true
                    },
                    {
                        "url": null,
                        "label": "Next &raquo;",
                        "active": false
                    }
                ],
                "path": "http:\/\/localhost\/api\/equipment",
                "per_page": 2,
                "to": 2,
                "total": 2
            }
        }
     */
    public function find(Request $request, EquipmentTypeRepository $repository): EquipmentTypeCollection
    {
        $items = $repository->find($request->all())->paginate(2);

        return new EquipmentTypeCollection($items);
    }
}
