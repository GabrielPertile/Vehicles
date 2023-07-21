<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\UpdateBrand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateBrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $translator->translate('app.vehicle.api_use_case.brand.update.success'),
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
