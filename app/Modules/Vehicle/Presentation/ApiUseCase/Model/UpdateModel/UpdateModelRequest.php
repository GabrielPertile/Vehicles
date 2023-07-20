<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Model\UpdateModel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateModelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('models', 'name')
                    ->where('brand_id', $this->brand_id)
                    ->ignore($this->id)
            ],
        ];
    }
}
