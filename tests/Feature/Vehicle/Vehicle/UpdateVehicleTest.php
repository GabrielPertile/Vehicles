<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Modules\Vehicle\Data\Dao\BrandDao;

use App\Modules\Vehicle\Data\Dao\ModelDao;
use App\Modules\Vehicle\Data\Dao\VehicleDao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateVehicleTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    // use DatabaseTransactions;
    /**
     * Test update de veículo enviando parâmetros vazios
     */
    public function test_update_vehicle_without_params_returns_unprocessable_entity_response(): void
    {
        $vehicle = $this->makeVehicle();
        $response = $this->put("/admin/vehicles/$vehicle->id", [], $this->getHederParam());

        $response->assertStatus(422);
    }

    /**
     * Test update de veículo enviando descrição inválida
     */
    public function test_update_vehicle_without_description_returns_unprocessable_entity_response(): void
    {
        $vehicle = $this->makeVehicle();

        $response = $this->put("/admin/vehicles/$vehicle->id", [
            'description' => '',
            'model_id' => $vehicle->model_id,
            'brand_id' => $vehicle->brand_id,
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
     * Test update de veículo enviando preço inválida
     */
    public function test_update_vehicle_without_price_returns_unprocessable_entity_response(): void
    {
        $vehicle = $this->makeVehicle();

        $response = $this->put("/admin/vehicles/$vehicle->id", [
            'description' => fake()->realText(50),
            'model_id' => $vehicle->model_id,
            'brand_id' => $vehicle->brand_id,
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
     * Test update de veículo enviando modelo não existente na marca
     */
    public function test_update_vehicle_with_non_existent_model_returns_unprocessable_entity_response(): void
    {
        $vehicle = $this->makeVehicle();
        $model = $this->makeModel();

        $response = $this->put("/admin/vehicles/$vehicle->id", [
            'description' => fake()->realText(50),
            'model_id' => $model->id,
            'brand_id' => $vehicle->brand_id,
            'price' => fake()->numberBetween(10, 100000),
            'image' => $this->createFile()
        ], $this->getHederParam());

        $response->assertStatus(422);
        $this->assertEquals($this->translator->translate('validation.validation_exception.invalid'), $response['data']['message']);
        $this->assertArrayHasKey('errors', $response['data']);
        info($response['data']['errors']);
        $this->assertArrayHasKey('model_id', $response['data']['errors']);
        $this->assertEquals(
            $this->translator->translate('validation.exists', [
                'attribute' => $this->translator->translate('validation.attributes.model_id')
            ]),
            head($response['data']['errors']['model_id'])
        );
    }

    /**
     * Test update de veículo enviando campo imagem sem outro arquivo não permitido
     */
    public function test_update_vehicle_with_image_field_not_allowed_returns_unprocessable_entity_response(): void
    {
        $vehicle = $this->makeVehicle();

        $response = $this->put("/admin/vehicles/$vehicle->id", [
            'description' => fake()->realText(50),
            'model_id' => $vehicle->model_id,
            'brand_id' => $vehicle->brand_id,
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
     * Test update de veículo sucesso
     */
    public function test_update_vehicle_with_valid_parameters_and_returns_redirect_response(): void
    {
        $vehicle = $this->makeVehicle();

        $model = $this->makeModel();
        $data = [
            'description' => fake()->realText(50),
            'model_id' => $model->id,
            'brand_id' => $model->brand_id,
            'price' => fake()->numberBetween(10, 100000),
            'image' => $this->createFile()
        ];

        $response = $this->put("/admin/vehicles/$vehicle->id", $data, $this->getHederParam());

        $response->assertStatus(302);
        $vehicle = VehicleDao::first();
        $this->assertEquals($data['description'], $vehicle->description);
        $this->assertEquals($data['model_id'], $vehicle->model_id);
        $this->assertEquals($data['brand_id'], $vehicle->brand_id);
        $this->assertEquals($data['price'], $vehicle->price);
    }
}
