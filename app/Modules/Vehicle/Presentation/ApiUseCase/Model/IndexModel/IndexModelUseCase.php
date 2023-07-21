<?php

namespace App\Modules\Vehicle\Presentation\ApiUseCase\Model\IndexModel;

use App\Modules\Vehicle\Data\Dao\ModelDao;

class IndexModelUseCase
{
    public function execute(IndexModelRequest $request)
    {
        $query = ModelDao::query();

        // Aplicar sortable

        $query = $query->paginate($request->pageSize, ['*'], 'page', $request->pageNumber);

        return $query;
    }
}
