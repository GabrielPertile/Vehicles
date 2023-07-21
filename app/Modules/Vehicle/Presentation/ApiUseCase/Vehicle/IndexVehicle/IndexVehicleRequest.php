<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\IndexVehicle;

use App\Modules\Core\Presentation\AbstractFormRequest;
use Illuminate\Validation\Rule;

class IndexVehicleRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [];
    }
}
