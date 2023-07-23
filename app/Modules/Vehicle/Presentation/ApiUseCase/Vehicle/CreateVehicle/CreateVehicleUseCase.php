<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle;

use Illuminate\Support\Facades\DB;
use App\Modules\Vehicle\Data\Dao\VehicleDao;
use App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle\CreateVehicleRequest;
use Illuminate\Support\Facades\Storage;

class CreateVehicleUseCase
{
    public function execute(CreateVehicleRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $vehicle = new VehicleDao($request->except('image'));

            $vehicle->save();

            $imageFile = $request->file('image');
            $fileName = "$vehicle->id-vehicles.{$imageFile->clientExtension()}";

            $path = $request->file('image')->storePubliclyAs('vehicles', $fileName);

            $vehicle->image = env('STORAGE_URL') . $path;

            $vehicle->save();
            return $vehicle;
        });
    }
}
