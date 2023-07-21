<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Model\IndexModel;

use App\Modules\Core\Presentation\AbstractFormRequest;
use Illuminate\Validation\Rule;

class IndexModelRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [];
    }
}
