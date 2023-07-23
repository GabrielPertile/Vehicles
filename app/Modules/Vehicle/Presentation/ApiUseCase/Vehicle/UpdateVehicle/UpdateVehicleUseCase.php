<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\UpdateVehicle;

use Illuminate\Support\Facades\DB;
use App\Modules\Vehicle\Data\Dao\VehicleDao;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\UpdateVehicle\UpdateVehicleRequest;

class UpdateVehicleUseCase
{
    public function execute(UpdateVehicleRequest $request, int $id): VehicleDao
    {
        $vehicle = VehicleDao::findOrFail($id);

        return DB::transaction(function () use ($vehicle, $request) {
            $vehicle->fill($request->except('image'));

            // Se mandar file novamente, irá salvar o novo
            if ($request->file('image')) {
                $imageFile = $request->file('image');
                $fileName = "$vehicle->id-vehicles.{$imageFile->clientExtension()}";

                $path = $request->file('image')->storePubliclyAs('vehicles', $fileName);

                $vehicle->image = env('STORAGE_URL') . $path;
            }

            $vehicle->save();

            return $vehicle;
        });
    }
}
