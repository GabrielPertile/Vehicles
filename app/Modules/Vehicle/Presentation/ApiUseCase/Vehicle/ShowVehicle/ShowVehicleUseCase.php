<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\ShowVehicle;

use App\Modules\Vehicle\Data\Dao\VehicleDao;

class ShowVehicleUseCase
{
    public function execute(int $id)
    {
        $vehicle = VehicleDao::findOrFail($id);

        return $vehicle;
    }
}
