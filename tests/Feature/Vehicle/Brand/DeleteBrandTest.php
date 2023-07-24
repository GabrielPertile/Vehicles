<?php

namespace Tests\Feature;

use App\Modules\Vehicle\Data\Dao\BrandDao;
use App\Modules\Vehicle\Data\Dao\ModelDao;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DeleteBrandTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * Test delete de marca não existente
     */
    public function test_delete_non_existent_brand_returns_not_found_response(): void
    {
        $brand = $this->makeBrand();

        $response = $this->delete("/admin/brands/1000", [], $this->getHederParam());

        $response->assertStatus(404);
    }

    /**
     * Test delete de marca e cascade de modelo
     */
    public function test_delete_brand_and_model_cascade(): void
    {
        $model = $this->makeModel();
        $response = $this->delete("/admin/brands/$model->brand_id", [], $this->getHederParam());

        $response->assertStatus(302);

        $this->assertEmpty(BrandDao::all());
        $this->assertEmpty(ModelDao::all());
    }
}
