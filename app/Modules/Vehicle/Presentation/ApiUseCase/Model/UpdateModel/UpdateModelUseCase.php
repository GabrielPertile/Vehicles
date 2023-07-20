<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Model\UpdateModel;

use App\Modules\Vehicle\Data\Dao\ModelDao;

class UpdateModelUseCase
{
    public function execute(UpdateModelRequest $request, int $id): ModelDao
    {
        $model = ModelDao::findOrFail($id);

        $model->fill($request->validated());

        $model->save();

        return $model;
    }
}
