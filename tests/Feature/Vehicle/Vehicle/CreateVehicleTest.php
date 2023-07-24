<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\Vehicle\Data\Dao\BrandDao;

use App\Modules\Vehicle\Data\Dao\ModelDao;
use App\Modules\Vehicle\Data\Dao\VehicleDao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;

class CreateVehicleTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    private array $data = [
        'name' => 'Test Marca'
    ];

    // use DatabaseTransactions;
    /**
     * Test cadastro de veículo enviando parâmetros vazios
     */
    public function test_create_vehicle_without_params_returns_unprocessable_entity_response(): void
    {
        $response = $this->post('/admin/vehicles', [], $this->getHederParam());

        $response->assertStatus(422);
    }

    /**
     * Test cadastro de veículo enviando descrição inválida
     */
    public function test_create_vehicle_without_description_returns_unprocessable_entity_response(): void
    {
        $model = $this->makeModel();

        $response = $this->post('/admin/vehicles', [
            'description' => '',
            'model_id' => $model->id,
            'brand_id' => $model->brand_id,
            'price' => fake()->numberBetween(10, 100000),
            'image' => $this->createFile()
        ], $this->getHederParam());

        $response->assertStatus(422);
        $this->assertEquals($this->translator->translate('validation.validation_exception.invalid'), $response['data']['message']);
        $this->assertArrayHasKey('errors', $response['data']);

        $this->assertArrayHasKey('description', $response['data']['errors']);
        $this->assertEquals(
            $this->translator->translate('validation.required', [
                'attribute' => $this->translator->translate('validation.attributes.description')
            ]),
            head($response['data']['errors']['description'])
        );
    }

    /**
     * Test cadastro de veículo enviando priço inválida
     */
    public function test_create_vehicle_without_price_returns_unprocessable_entity_response(): void
    {
        $model = $this->makeModel();

        $response = $this->post('/admin/vehicles', [
            'description' => fake()->realText(50),
            'model_id' => $model->id,
            'brand_id' => $model->brand_id,
            'price' => null,
            'image' => $this->createFile()
        ], $this->getHederParam());

        $response->assertStatus(422);
        $this->assertEquals($this->translator->translate('validation.validation_exception.invalid'), $response['data']['message']);
        $this->assertArrayHasKey('errors', $response['data']);
        // info($response['data']['errors']);
        $this->assertArrayHasKey('price', $response['data']['errors']);
        $this->assertEquals(
            $this->translator->translate('validation.required', [
                'attribute' => $this->translator->translate('validation.attributes.price')
            ]),
            head($response['data']['errors']['price'])
        );
    }

    /**
     * Test cadastro de veículo enviando sem image
     */
    public function test_create_vehicle_without_image_returns_unprocessable_entity_response(): void
    {
        $model = $this->makeModel();

        $response = $this->post('/admin/vehicles', [
            'description' => fake()->realText(50),
            'model_id' => $model->id,
            'brand_id' => $model->brand_id,
            'price' => fake()->numberBetween(10, 100000),
            'image' => null
        ], $this->getHederParam());

        $response->assertStatus(422);
        $this->assertEquals($this->translator->translate('validation.validation_exception.invalid'), $response['data']['message']);
        $this->assertArrayHasKey('errors', $response['data']);
        $this->assertArrayHasKey('image', $response['data']['errors']);
        $this->assertEquals(
            $this->translator->translate('validation.required', [
                'attribute' => $this->translator->translate('validation.attributes.image')
            ]),
            head($response['data']['errors']['image'])
        );
    }

    /**
     * Test cadastro de veículo enviando campo imagem sem outro arquivo não permitido
     */
    public function test_create_vehicle_with_image_field_not_allowed_returns_unprocessable_entity_response(): void
    {
        $model = $this->makeModel();

        $response = $this->post('/admin/vehicles', [
            'description' => fake()->realText(50),
            'model_id' => $model->id,
            'brand_id' => $model->brand_id,
            'price' => fake()->numberBetween(10, 100000),
            'image' => $this->createFile('pdf', 1024, 'application/pdf')
        ], $this->getHederParam());

        $response->assertStatus(422);
        $this->assertEquals($this->translator->translate('validation.validation_exception.invalid'), $response['data']['message']);
        $this->assertArrayHasKey('errors', $response['data']);
        $this->assertArrayHasKey('image', $response['data']['errors']);

        $this->assertEquals(
            $this->translator->translate('validation.image', [
                'attribute' => $this->translator->translate('validation.attributes.image')
            ]),
            head($response['data']['errors']['image'])
        );
        $this->assertEquals(
            $this->translator->translate('validation.mimes', [
                'attribute' => $this->translator->translate('validation.attributes.image'),
                'values' => 'png, jpg, jpeg'
            ]),
            last($response['data']['errors']['image'])
        );
    }

    /**
     * Test cadastro de veículo sucesso
     */
    public function test_create_vehicle_with_valid_parameters_and_returns_redirect_response(): void
    {
        $model = $this->makeModel();
        $data = [
            'description' => fake()->realText(50),
            'model_id' => $model->id,
            'brand_id' => $model->brand_id,
            'price' => fake()->numberBetween(10, 100000),
            'image' => $this->createFile()
        ];

        $response = $this->post('/admin/vehicles', $data, $this->getHederParam());

        $response->assertStatus(302);
        $vehicle = VehicleDao::first();
        $this->assertEquals($data['description'], $vehicle->description);
        $this->assertEquals($data['model_id'], $vehicle->model_id);
        $this->assertEquals($data['brand_id'], $vehicle->brand_id);
        $this->assertEquals($data['price'], $vehicle->price);
    }
}
