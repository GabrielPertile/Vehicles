<?php

namespace Database\Factories\Modules\Vehicle\Data\Dao;

use App\Modules\Vehicle\Data\Dao\BrandDao;
use App\Modules\Vehicle\Data\Dao\ModelDao;
use App\Modules\Vehicle\Data\Dao\VehicleDao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class VehicleDaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VehicleDao::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $model = ModelDao::factory()->create();
        return [
            'description' => fake()->realText(50),
            'brand_id' => $model->brand_id,
            'model_id' => $model->id,
            'price' => fake()->numberBetween(10, 100000),
            'image' => null
        ];
    }
}
