<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Brand\CreateBrand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBrandRequest extends FormRequest
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
                Rule::unique('brands', 'name')
            ]
        ];
    }

    public function redirect()
    {
        dd('entrou aqui');
        return redirect()->to(route('brands'));
    }
}
