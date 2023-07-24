<?php

namespace Tests\Feature;

use App\Modules\Vehicle\Data\Dao\VehicleDao;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DeleteVehicleTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * Test delete de veículo não existente
     */
    public function test_delete_non_existent_vehicle_returns_not_found_response(): void
    {
        $response = $this->delete("/admin/vehicles/1000", [], $this->getHederParam());

        $response->assertStatus(404);
    }

    /**
     * Test delete de veículo
     */
    public function test_delete_vehicle_and_returns_redirect_response(): void
    {
        $vehicle = $this->makeVehicle();
        $response = $this->delete("/admin/vehicles/$vehicle->id", [], $this->getHederParam());

        $response->assertStatus(302);
        $this->assertEmpty(VehicleDao::all());
    }
}
