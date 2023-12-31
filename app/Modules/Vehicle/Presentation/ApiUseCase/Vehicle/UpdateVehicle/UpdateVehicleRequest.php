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
            'description' => 'required|min:12|max:1000|nullable',
            'brand_id' => 'required|exists:brands,id',
            'model_id' => [
                'required',
                Rule::exists('models', 'id')
                    ->where('brand_id', $this->brand_id)
            ],
            'price' => 'required|numeric|gt:0',
            'image' => 'sometimes|image|mimes:png,jpg,jpeg|max:5120|nullable',
        ];
    }
}
