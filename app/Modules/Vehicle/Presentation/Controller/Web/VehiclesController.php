<?php

namespace App\Modules\Vehicle\Presentation\Controller\Web;

use App\Http\Controllers\Controller;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle\IndexVehicleRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle\IndexVehicleUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle\IndexVehicleResource;

class VehiclesController extends Controller
{

    /**
     * @group Vehicle
     * @route [GET] /
     * @title Listar carros
     * @param IndexVehicleUseCase $useCase
     * @param IndexVehicleRequest $request
     */
    public function index(IndexVehicleUseCase $useCase, IndexVehicleRequest $request)
    {
        $vehicles = IndexVehicleResource::collection($useCase->execute($request));
        return view(
            'web.vehicle.index',
            compact('vehicles')
        );
    }
}
