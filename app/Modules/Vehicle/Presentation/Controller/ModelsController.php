<?php

namespace App\Modules\Vehicle\Presentation\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\ShowModel\ShowModelUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\ShowModel\ShowModelResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand\IndexBrandUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\IndexModel\IndexModelRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\IndexModel\IndexModelUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand\IndexBrandResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\IndexModel\IndexModelResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\CreateModel\CreateModelRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\CreateModel\CreateModelUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\DeleteModel\DeleteModelRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\DeleteModel\DeleteModelUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\UpdateModel\UpdateModelRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\UpdateModel\UpdateModelUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\CreateModel\CreateModelResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\DeleteModel\DeleteModelResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\UpdateModel\UpdateModelResource;

class ModelsController extends Controller
{

    /**
     * @group Vehicle
     * @route [GET] /api/models
     * @title Listar modelos de carro
     * @param IndexModelUseCase $useCase
     * @param IndexModelRequest $request
     */
    public function index(IndexModelUseCase $useCase, IndexModelRequest $request, IndexBrandUseCase $brandUseCase)
    {
        $models = IndexModelResource::collection($useCase->execute($request));
        $brands = IndexBrandResource::collection($brandUseCase->execute($request));
        return view(
            'admin.model.index',
            compact('models', 'brands')
        );
    }

    /**
     * @group Vehicle
     * @route [GET] /api/models/{id}
     * @title Visualizar modelo de carro
     * @param IndexModelUseCase $useCase
     * @param int $id
     * @return JsonResource
     */
    public function show(ShowModelUseCase $useCase, int $id): JsonResource
    {
        return ShowModelResource::make($useCase->execute($id));
    }

    /**
     * @group Vehicle
     * @route [POST] /api/models
     * @title Cadatrar modelo de carro
     * @param CreateModelUseCase $useCase
     * @param CreateModelRequest $request
     */
    public function store(CreateModelUseCase $useCase, CreateModelRequest $request)
    {
        return redirect()->route('models.index')->with(CreateModelResource::make($useCase->execute($request))->toArray($request))->withInput(['id' => null]);
    }

    /**
     * @group Vehicle
     * @route [POST] /api/models
     * @title Atualziar modelo de carro
     * @param UpdateModelUseCase $useCase
     * @param UpdateModelRequest $request
     */
    public function update(UpdateModelUseCase $useCase, UpdateModelRequest $request, int $id)
    {
        return redirect()
            ->route('models.index')
            ->with(UpdateModelResource::make($useCase->execute($request, $id))->toArray($request))
            ->withInput(['id' => $id]);
    }

    public function destroy(DeleteModelUseCase $useCase, DeleteModelRequest $request, int $id)
    {
        return redirect()->route('models.index')->with(DeleteModelResource::make($useCase->execute($id))->toArray($request));
    }
}
