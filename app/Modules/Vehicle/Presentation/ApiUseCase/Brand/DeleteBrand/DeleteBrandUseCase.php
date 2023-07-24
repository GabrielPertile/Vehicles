<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\DeleteBrand;

use App\Modules\Vehicle\Data\Dao\BrandDao;

class DeleteBrandUseCase
{
    public function execute(int $id): void
    {
        $brand = BrandDao::findOrFail($id);
        $brand->delete();
    }
}
