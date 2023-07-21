<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\ShowBrand;

use App\Modules\Vehicle\Data\Dao\BrandDao;

class ShowBrandUseCase
{
    public function execute(int $id): BrandDao
    {
        $brand = BrandDao::findOrFail($id);

        return $brand;
    }
}
