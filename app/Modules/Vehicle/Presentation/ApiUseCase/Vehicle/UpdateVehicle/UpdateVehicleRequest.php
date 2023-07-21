<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Vehicle\UpdateVehicle;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVehicleRequest extends FormRequest
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
            'description' => 'required|max:1000|nullable',
            'brand_id' => 'required|exists:brands,id',
            'model_id' => [
                'required',
                Rule::exists('models', 'id')
                    ->where('brand_id', $this->brand_id)
            ],
            'price' => 'required|numeric|gt:0',
            'image' => 'nullable',
        ];
    }
}
