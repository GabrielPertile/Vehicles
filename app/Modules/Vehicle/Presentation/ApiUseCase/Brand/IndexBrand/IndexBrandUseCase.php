<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand;

use App\Modules\Vehicle\Data\Dao\BrandDao;
use Illuminate\Foundation\Http\FormRequest;

class IndexBrandUseCase
{
    public function execute(FormRequest $request)
    {
        $query = BrandDao::all();

        // Aplicar sortable

        // $query = $query->paginate($request->pageSize, ['*'], 'page', $request->pageNumber);

        return $query;
    }
}
