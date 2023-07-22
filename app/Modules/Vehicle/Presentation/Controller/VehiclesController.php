<?php

namespace App\Modules\Vehicle\Presentation\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand\IndexBrandUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\ShowVehicle\ShowVehicleRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\ShowVehicle\ShowVehicleUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\ShowVehicle\ShowVehicleResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle\IndexVehicleRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle\IndexVehicleUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle\IndexVehicleResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle\CreateVehicleRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle\CreateVehicleUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\DeleteVehicle\DeleteVehicleRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\DeleteVehicle\DeleteVehicleUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\UpdateVehicle\UpdateVehicleRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\UpdateVehicle\UpdateVehicleUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle\CreateVehicleResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\DeleteVehicle\DeleteVehicleResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand\IndexBrandByVehiclesResource;

class VehiclesController extends Controller
{

    /**
     * @group Vehicle
     * @route [GET] /api/vehicles
     * @title Listar carros
     * @param CreateVehicleUseCase $useCase
     * @param CreateVehicleRequest $request
     */
    public function index(IndexVehicleUseCase $useCase, IndexVehicleRequest $request,  IndexBrandUseCase $brandUseCase)
    {
        $vehicles = IndexVehicleResource::collection($useCase->execute($request));
        $brands = IndexBrandByVehiclesResource::collection($brandUseCase->execute($request));

        return view(
            'admin.vehicle.index',
            compact('vehicles', 'brands')
        );
    }

    /**
     * @group Vehicle
     * @route [GET] /api/vehicles/{id}
     * @title visualizar carro
     * @param CreateVehicleUseCase $useCase
     * @param int $id
     * @return JsonResource
     */
    public function show(ShowVehicleUseCase $useCase, int $id)
    {
        return ShowVehicleResource::make($useCase->execute($id));
    }

    /**
     * @group Vehicle
     * @route [POST] /api/vehicles
     * @title Cadatrar carro
     * @param CreateVehicleUseCase $useCase
     * @param CreateVehicleRequest $request
     */
    public function store(CreateVehicleUseCase $useCase, CreateVehicleRequest $request)
    {
        return redirect()
            ->route('vehicles.index')
            ->with(CreateVehicleResource::make($useCase->execute($request))->toArray($request));
    }

    /**
     * @group Vehicle
     * @route [PUT] /api/Vehicles/{id}
     * @title Atualizar marca de carro
     * @param UpdateVehicleUseCase $useCase
     * @param UpdateVehicleRequest $request
     * @param int $id
     */
    public function update(UpdateVehicleUseCase $useCase, UpdateVehicleRequest $request, int $id)
    {
        return redirect()
            ->route('vehicles.index')
            ->with(CreateVehicleResource::make($useCase->execute($request, $id))->toArray($request))
            ->withInput(['id' => $id]);
    }

    public function destroy(DeleteVehicleUseCase $useCase, DeleteVehicleRequest $request, int $id)
    {
        return redirect()->route('vehicles.index')->with(DeleteVehicleResource::make($useCase->execute($id))->toArray($request));
    }
}
