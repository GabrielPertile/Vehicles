<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\DeleteVehicle;

use Illuminate\Http\Request;
use App\Libraries\Translator;
use Illuminate\Http\Resources\Json\JsonResource;

class DeleteVehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        $translator = new Translator();
        return [
            'message' => $translator->translate('app.vehicle.api_use_case.vehicle.destroy.success'),
        ];
    }
}
