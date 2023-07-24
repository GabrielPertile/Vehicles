<?php

namespace App\Modules\Vehicle\Presentation\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Vehicle\Data\Dao\BrandDao;
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
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\DeleteBrand\DeleteBrandRequest;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\DeleteBrand\DeleteBrandResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\DeleteBrand\DeleteBrandUseCase;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\ShowBrand\ShowBrandResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\UpdateBrand\UpdateBrandResource;
use Illuminate\Support\Facades\Redirect;

class BrandsController extends Controller
{

    /**
     * @group Vehicle
     * @route [GET] /api/brands
     * @title listar marcas
     * @param IndexBrandUseCase $useCase
     * @param IndexBrandRequest $request
     */
    public function index(IndexBrandUseCase $useCase, IndexBrandRequest $request)
    {
        $brands = IndexBrandResource::collection($useCase->execute($request));
        return view(
            'admin.brand.index',
            compact('brands')
        );
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
    public function store(CreateBrandUseCase $useCase, CreateBrandRequest $request)
    {
        return redirect()->back()->with(CreateBrandResource::make($useCase->execute($request))->toArray($request))->withInput(['id' => null]);
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
    public function update(UpdateBrandUseCase $useCase, UpdateBrandRequest $request, int $id)/*  */
    {
        return back()->with(UpdateBrandResource::make($useCase->execute($request, $id))->toArray($request))->withInput(['id' => $id]);
        // return CreateBrandResource::make($useCase->execute($request, $id));
    }

    public function destroy(DeleteBrandUseCase $useCase, DeleteBrandRequest $request, int $id)
    {
        return redirect()->route('brands.index')->with(DeleteBrandResource::make($useCase->execute($id))->toArray($request));
    }
}
