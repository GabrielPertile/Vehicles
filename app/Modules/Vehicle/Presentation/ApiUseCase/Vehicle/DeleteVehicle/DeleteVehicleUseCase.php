<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\DeleteVehicle;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Modules\Vehicle\Data\Dao\VehicleDao;
use Illuminate\Support\Str;

class DeleteVehicleUseCase
{
    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            $vehicle = VehicleDao::findOrFail($id);

            if ($vehicle->image && Storage::disk('public')->exists(Str::replace(env('STORAGE_URL'), '', $vehicle->image))) {
                Storage::disk('public')->delete(Str::replace(env('STORAGE_URL'), '', $vehicle->image));
            }
            $vehicle->delete();
        });
    }
}
