<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle;

use App\Modules\Vehicle\Data\Dao\VehicleDao;

class IndexVehicleUseCase
{
    public function execute(IndexVehicleRequest $request)
    {
        $query = VehicleDao::query();

        // Aplicar sortable

        $query = $query->paginate($request->pageSize, ['*'], 'page', $request->pageNumber);

        return $query;
    }
}
