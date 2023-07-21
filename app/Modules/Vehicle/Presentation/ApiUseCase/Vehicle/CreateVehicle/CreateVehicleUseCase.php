<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle;

use App\Modules\Vehicle\Data\Dao\VehicleDao;

class CreateVehicleUseCase
{
    public function execute(CreateVehicleRequest $request): VehicleDao
    {
        $model = new VehicleDao($request->validated());

        $model->save();

        return $model;
    }
}
