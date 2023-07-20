<?php

namespace App\Modules\Vehicle\Presentation\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\CreateModel\CreateModelRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\CreateModel\CreateModelResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\CreateModel\CreateModelUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\UpdateModel\UpdateModelRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\UpdateModel\UpdateModelResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\UpdateModel\UpdateModelUseCase;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelsController extends Controller
{

    /**
     * @group Vehicle
     * @route [POST] /api/models
     * @title Cadatrar modelo de carro
     * @param CreateModelUseCase $useCase
     * @param CreateModelRequest $request
     * @return JsonResource
     */
    public function store(CreateModelUseCase $useCase, CreateModelRequest $request): JsonResource
    {
        return CreateModelResource::make($useCase->execute($request));
    }

    /**
     * @group Vehicle
     * @route [POST] /api/models
     * @title Atualziar modelo de carro
     * @param UpdateModelUseCase $useCase
     * @param UpdateModelRequest $request
     * @return JsonResource
     */
    public function update(UpdateModelUseCase $useCase, UpdateModelRequest $request, int $id): JsonResource
    {
        return UpdateModelResource::make($useCase->execute($request, $id));
    }
}
