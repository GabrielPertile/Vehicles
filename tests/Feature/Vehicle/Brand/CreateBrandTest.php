<?php

namespace Tests\Feature;

use App\Modules\Vehicle\Data\Dao\BrandDao;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateBrandTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;


    private array $data = [
        'name' => 'Test Marca'
    ];

    // use DatabaseTransactions;
    /**
     * Test cadastro de marca enviando parâmetros vazios
     */
    public function test_create_brand_without_params_returns_unprocessable_entity_response(): void
    {
        $response = $this->post('/admin/brands', [], $this->getHederParam());

        $response->assertStatus(422);
    }

    /**
     * Test cadastro de marca enviando name inválido
     */
    public function test_create_brand_with_invalid_name_length_returns_unprocessable_entity_response(): void
    {
        $response = $this->post('/admin/brands', [
            'name' => '1'
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
     * Test cadastro de marca enviando name já existente
     */
    public function test_create_brand_with_existing_name_returns_unprocessable_entity_response(): void
    {
        $brand = BrandDao::factory()->create();
        $response = $this->post('/admin/brands', [
            'name' => $brand->name
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
     * Test cadastro de marca enviando name ok
     */
    public function test_create_brand_with_valid_parameters_and_returns_redirect_response(): void
    {
        $response = $this->post('/admin/brands', $this->data, $this->getHederParam());

        $response->assertStatus(302);

        $brand = BrandDao::first();
        $this->assertEquals($this->data['name'], $brand->name);
    }
}
