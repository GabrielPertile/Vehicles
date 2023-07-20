<?php

namespace App\Modules\Vehicle\Presentation\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\CreateBrand\CreateBrandRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\CreateBrand\CreateBrandResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\CreateBrand\CreateBrandUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\UpdateBrand\UpdateBrandRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\UpdateBrand\UpdateBrandUseCase;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandsController extends Controller
{

    /**
     *
     */
    public function index()
    {

    }

    /**
     *
     */
    public function store(CreateBrandUseCase $useCase, CreateBrandRequest $request): JsonResource
    {
        return CreateBrandResource::make($useCase->execute($request));
    }

    public function update(UpdateBrandUseCase $useCase, UpdateBrandRequest $request, int $id): JsonResource
    {
        return CreateBrandResource::make($useCase->execute($request, $id));
    }
}
