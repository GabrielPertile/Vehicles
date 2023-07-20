<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\UpdateBrand;

use App\Modules\Vehicle\Data\Dao\BrandDao;

class UpdateBrandUseCase
{
    public function execute(UpdateBrandRequest $request, int $id)
    {
        $brand = BrandDao::findOrFail($id);

        $brand->fill($request->validated());

        $brand->save();
        return $brand;
    }
}
