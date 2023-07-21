<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Model\ShowModel;

use App\Modules\Vehicle\Data\Dao\ModelDao;

class ShowModelUseCase
{
    public function execute(int $id)
    {
        $model = ModelDao::findOrFail($id);

        return $model;
    }
}
