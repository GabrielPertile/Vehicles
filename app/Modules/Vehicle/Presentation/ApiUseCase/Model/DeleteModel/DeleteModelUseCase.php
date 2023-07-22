<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Model\DeleteModel;

use App\Modules\Vehicle\Data\Dao\ModelDao;

class DeleteModelUseCase
{
    public function execute(int $id): void
    {
        $model = ModelDao::find($id);
        $model->delete();
    }
}
