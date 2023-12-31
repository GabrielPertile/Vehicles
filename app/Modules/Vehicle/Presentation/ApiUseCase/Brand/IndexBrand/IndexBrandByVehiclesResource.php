<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand;

use App\Libraries\Translator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexBrandByVehiclesResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'models' => $this->models
        ];
    }
}
