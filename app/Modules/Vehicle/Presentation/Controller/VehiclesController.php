<?php

namespace App\Modules\Vehicle\Presentation\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle\IndexVehicleRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle\IndexVehicleUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle\IndexVehicleResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle\CreateVehicleRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle\CreateVehicleUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\UpdateVehicle\UpdateVehicleRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\UpdateVehicle\UpdateVehicleUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle\CreateVehicleResource;

class VehiclesController extends Controller
{

    public function index(IndexVehicleUseCase $useCase, IndexVehicleRequest $request): JsonResource
    {
        return IndexVehicleResource::collection($useCase->execute($request));
    }

    /**
     * @group Vehicle
     * @route [POST] /api/vehicles
     * @title Cadatrar carro
     * @param CreateVehicleUseCase $useCase
     * @param CreateVehicleRequest $request
     * @return JsonResource
     */
    public function store(CreateVehicleUseCase $useCase, CreateVehicleRequest $request): JsonResource
    {
        return CreateVehicleResource::make($useCase->execute($request));
    }

    /**
     * @group Vehicle
     * @route [POST] /api/Vehicles
     * @title Atualizar marca de carro
     * @param UpdateVehicleUseCase $useCase
     * @param UpdateVehicleRequest $request
     * @return JsonResource
     */
    public function update(UpdateVehicleUseCase $useCase, UpdateVehicleRequest $request, int $id): JsonResource
    {
        return CreateVehicleResource::make($useCase->execute($request, $id));
    }
}
