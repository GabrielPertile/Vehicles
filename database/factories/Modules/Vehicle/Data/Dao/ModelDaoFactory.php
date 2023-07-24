<?php

namespace Database\Factories\Modules\Vehicle\Data\Dao;

use App\Modules\Vehicle\Data\Dao\BrandDao;
use App\Modules\Vehicle\Data\Dao\ModelDao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ModelDaoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ModelDao::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->company(),
            'brand_id' => BrandDao::factory()
        ];
    }
}
