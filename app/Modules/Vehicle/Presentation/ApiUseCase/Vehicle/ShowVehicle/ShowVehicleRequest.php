<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\ShowVehicle;

use App\Modules\Core\Presentation\AbstractFormRequest;
use Illuminate\Validation\Rule;

class ShowVehicleRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [];
    }
}
