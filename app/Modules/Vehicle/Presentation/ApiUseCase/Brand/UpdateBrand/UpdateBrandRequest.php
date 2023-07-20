<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\UpdateBrand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
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

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:3',
                'max:100',
                Rule::unique('brands', 'name')
                    ->ignore($this->id)
            ]
        ];
    }
}
