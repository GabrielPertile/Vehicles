<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\ShowVehicle;

use Illuminate\Http\Request;
use App\Libraries\Translator;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Brand\IndexBrand\IndexBrandResource;
use App\Modules\Vehicle\Presentation\ApiUseCase\Model\IndexModel\IndexModelResource;

class ShowVehicleResource extends JsonResource
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
            'description' => $this->description,
            'brand' => IndexBrandResource::make($this->brand),
            'model' => IndexModelResource::make($this->model)
        ];
    }
}
