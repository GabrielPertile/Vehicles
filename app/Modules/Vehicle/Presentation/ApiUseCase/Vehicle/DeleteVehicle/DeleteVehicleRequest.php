<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\DeleteVehicle;

use App\Modules\Core\Presentation\AbstractFormRequest;
use Illuminate\Validation\Rule;

class DeleteVehicleRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [];
    }
}
