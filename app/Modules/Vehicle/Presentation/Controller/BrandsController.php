<?php

namespace App\Modules\Vehicle\Presentation\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\ShowBrand\ShowBrandUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand\IndexBrandRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand\IndexBrandUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand\IndexBrandResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\CreateBrand\CreateBrandRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\CreateBrand\CreateBrandUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\UpdateBrand\UpdateBrandRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\UpdateBrand\UpdateBrandUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\CreateBrand\CreateBrandResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\ShowBrand\ShowBrandResource;

class BrandsController extends Controller
{

    /**
     * @group Vehicle
     * @route [GET] /api/brands
     * @title listar marcas
     * @param IndexBrandUseCase $useCase
     * @param IndexBrandRequest $request
     * @return JsonResource
     */
    public function index(IndexBrandUseCase $useCase, IndexBrandRequest $request): JsonResource
    {
        return IndexBrandResource::collection($useCase->execute($request));
    }

    /**
     * @group Vehicle
     * @route [GET] /api/brands/{id}
     * @title visualizar marca
     * @param ShowBrandUseCase $useCase
     * @param int $id
     * @return JsonResource
     */
    public function show(ShowBrandUseCase $useCase, int $id): JsonResource
    {
        return ShowBrandResource::make($useCase->execute($id));
    }

    /**
     * @group Vehicle
     * @route [POST] /api/brands
     * @title Cadatrar marca de carro
     * @param CreateBrandUseCase $useCase
     * @param CreateBrandRequest $request
     * @return JsonResource
     */
    public function store(CreateBrandUseCase $useCase, CreateBrandRequest $request): JsonResource
    {
        return CreateBrandResource::make($useCase->execute($request));
    }

    /**
     * @group Vehicle
     * @route [PUT] /api/brands/{id}
     * @title Atualizar marca de carro
     * @param UpdateBrandUseCase $useCase
     * @param UpdateBrandRequest $request
     * @param int $id
     * @return JsonResource
     */
    public function update(UpdateBrandUseCase $useCase, UpdateBrandRequest $request, int $id): JsonResource
    {
        return CreateBrandResource::make($useCase->execute($request, $id));
    }
}
