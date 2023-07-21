<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand;

use App\Modules\Vehicle\Data\Dao\BrandDao;

class IndexBrandUseCase
{
    public function execute(IndexBrandRequest $request)
    {
        $query = BrandDao::query();

        // Aplicar sortable

        $query = $query->paginate($request->pageSize, ['*'], 'page', $request->pageNumber);

        return $query;
    }
}
