<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\Vehicle\Data\Dao\BrandDao;

use App\Modules\Vehicle\Data\Dao\ModelDao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateModelTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private array $data = [
        'name' => 'Test Marca'
    ];

    // use DatabaseTransactions;
    /**
     * Test cadastro de modelo enviando parâmetros vazios
     */
    public function test_create_model_without_params_returns_unprocessable_entity_response(): void
    {
        $response = $this->post('/admin/models', [], $this->getHederParam());

        $response->assertStatus(422);
    }

    /**
     * Test cadastro de modelo enviando name inválido
     */
    public function test_create_model_with_invalid_name_length_returns_unprocessable_entity_response(): void
    {
        $brand = $this->makeBrand();

        $response = $this->post('/admin/models', [
            'name' => '1',
            'brand_id' => $brand->id
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
     * Test cadastro de modelo enviando marca inválida
     */
    public function test_create_model_with_invalid_brand_returns_unprocessable_entity_response(): void
    {
        $brand = $this->makeBrand();
        $response = $this->post('/admin/models', [
            'name' => $this->data['name'],
            'brand_id' => 10000
        ], $this->getHederParam());

        $response->assertStatus(422);
        $this->assertEquals($this->translator->translate('validation.validation_exception.invalid'), $response['data']['message']);
        $this->assertArrayHasKey('errors', $response['data']);
        $this->assertArrayHasKey('brand_id', $response['data']['errors']);
        $this->assertEquals(
            $this->translator->translate('validation.exists', [
                'attribute' => $this->translator->translate('validation.attributes.brand_id'),
            ]),
            head($response['data']['errors']['brand_id'])
        );
    }

    /**
     * Test cadastro de modelo enviando name já existente
     */
    public function test_create_model_with_existing_name_returns_unprocessable_entity_response(): void
    {
        $model = $this->makeModel();
        $response = $this->post('/admin/models', [
            'name' => $model->name,
            'brand_id' => $model->brand->id
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
     * Test cadastro de modelo enviando name ok
     */
    public function test_create_model_with_valid_parameters_and_returns_redirect_response(): void
    {
        $brand = $this->makeBrand();

        $response = $this->post('/admin/models', [
            'name' => $this->data['name'],
            'brand_id' => $brand->id
        ], $this->getHederParam());

        $response->assertStatus(302);

        $model = ModelDao::first();
        $this->assertEquals($this->data['name'], $model->name);
    }
}
