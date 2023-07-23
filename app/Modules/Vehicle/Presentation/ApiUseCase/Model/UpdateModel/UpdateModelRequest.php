<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Model\UpdateModel;

use App\Modules\Vehicle\Data\Dao\ModelDao;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

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
            'brand_id' => 'required|exists:brands,id',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $model = ModelDao::findOrFail($this->id);

        $validator->after(function ($validator) use ($model) {
            // Se estiver mudando de marca e o modelo possui veículos, lançará erro pois irá gerar inconsistência
            if (($model->brand_id != $this->brand_id) && $model->vehicles->count() > 0) {

                return $validator->errors()->add('brand_id', trans('app.vehicle.api_use_case.model.update.error_brand_already_in_use'));
            }
        });
    }
}
