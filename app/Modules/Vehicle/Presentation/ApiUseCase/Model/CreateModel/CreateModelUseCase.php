<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Model\CreateModel;

use App\Modules\Vehicle\Data\Dao\ModelDao;

class CreateModelUseCase
{
    public function execute(CreateModelRequest $request): ModelDao
    {
        $model = new ModelDao($request->validated());

        $model->save();

        return $model;
    }
}
