<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Model\DeleteModel;

use App\Modules\Core\Presentation\AbstractFormRequest;
use Illuminate\Validation\Rule;

// TODO Aplicar regras de validação
class DeleteModelRequest extends AbstractFormRequest
{
    public function rules()
    {
        return [];
    }
}
