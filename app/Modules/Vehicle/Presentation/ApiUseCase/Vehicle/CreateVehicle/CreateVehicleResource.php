<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\CreateVehicle;

use App\Libraries\Translator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateVehicleResource extends JsonResource
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
            'message' => $translator->translate('app.vehicle.api_use_case.vehicle.store.success'),
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
