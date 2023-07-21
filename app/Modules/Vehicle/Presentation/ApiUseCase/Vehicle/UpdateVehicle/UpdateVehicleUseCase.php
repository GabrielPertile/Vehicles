<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\UpdateVehicle;

use App\Modules\Vehicle\Data\Dao\VehicleDao;

class UpdateVehicleUseCase
{
    public function execute(UpdateVehicleRequest $request, int $id): VehicleDao
    {
        $model = VehicleDao::findOrFail($id);

        $model->fill($request->validated());

        $model->save();

        return $model;
    }
}
