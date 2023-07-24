<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\Vehicle\Data\Dao\BrandDao;

use App\Modules\Vehicle\Data\Dao\ModelDao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateModelTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private array $data = [
        'name' => 'Test Marca'
    ];

    /**
     * Test update de modelo enviando parâmetros vazios
     */
    public function test_update_model_without_params_returns_unprocessable_entity_response(): void
    {
        $model = $this->makeModel();

        $response = $this->put("/admin/models/$model->id", [], $this->getHederParam());

        $response->assertStatus(422);
    }

    /**
     * Test cadastro de modelo enviando name inválido
     */
    public function test_update_model_with_invalid_name_length_returns_unprocessable_entity_response(): void
    {
        $model = $this->makeModel();
        $response = $this->put("/admin/models/$model->id", [
            'name' => '1',
            'brand_id' => $model->brand_id
        ], $this->getHederParam());

        $response->assertStatus(422);
        $this->assertEquals($this->translator->translate('validation.validation_exception.invalid'), $response['data']['message']);
        $this->assertArrayHasKey('errors', $response['data']);
        $this->assertArrayHasKey('name', $response['data']['errors']);
        $this->assertEquals(
            $this->translator->translate('validation.min.string', [
                'attribute' => $this->translator->translate('validation.attributes.name'),
                'min' => 3
            ]),
            head($response['data']['errors']['name'])
        );
    }

    /**
     * Test update de modelo enviando name já existente
     */
    public function test_update_model_with_existing_name_returns_unprocessable_entity_response(): void
    {
        $models = $this->makeModels();

        $model = $models->first();
        $otherModel = $models->last();
        $response = $this->put("/admin/models/$model->id", [
            'name' => $otherModel->name,
            'brand_id' => $otherModel->brand_id
        ], $this->getHederParam());

        $response->assertStatus(422);
        $this->assertEquals($this->translator->translate('validation.validation_exception.invalid'), $response['data']['message']);
        $this->assertArrayHasKey('errors', $response['data']);
        $this->assertArrayHasKey('name', $response['data']['errors']);
        $this->assertEquals(
            $this->translator->translate('validation.unique', [
                'attribute' => $this->translator->translate('validation.attributes.name'),
            ]),
            head($response['data']['errors']['name'])
        );
    }

    /**
     * Test update de modelo enviando name ok
     */
    public function test_update_model_with_valid_parameters_and_returns_redirect_response(): void
    {
        $model = $this->makeModel();
        $name = "$model->name-UPDATE";
        $response = $this->put("/admin/models/$model->id", [
            'name' => $name,
            'brand_id' => $model->brand_id
        ], $this->getHederParam());

        $response->assertStatus(302);

        $model = ModelDao::first();
        $this->assertEquals($name, $model->name);
    }
}
