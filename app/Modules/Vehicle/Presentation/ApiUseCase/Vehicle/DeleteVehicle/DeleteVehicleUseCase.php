<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\DeleteVehicle;

use App\Modules\Vehicle\Data\Dao\VehicleDao;

class DeleteVehicleUseCase
{
    public function execute(int $id): void
    {
        $vehicle = VehicleDao::findOrFail($id);

        $vehicle->delete();
    }
}
