<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\CreateBrand;

use App\Modules\Vehicle\Data\Dao\BrandDao;

class CreateBrandUseCase
{
    public function execute(CreateBrandRequest $request): BrandDao
    {
        $brand = new BrandDao($request->validated());

        $brand->save();

        return $brand;
    }
}
