<?php

namespace Tests;

use App\Libraries\Translator;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use App\Modules\Vehicle\Data\Dao\BrandDao;
use App\Modules\Vehicle\Data\Dao\ModelDao;

trait CreatesApplication
{

    protected Translator $translator;

    public function setUp(): void
    {
        $this->translator = new Translator();
        parent::setUp();
    }

    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function getHederParam(): array
    {
        return ['Accept' => 'application/json', 'enctype' => 'multipart/form-data'];
    }

    protected function makeBrand()
    {
        return BrandDao::factory()->create();
    }

    protected function makeBrands()
    {
        return BrandDao::factory(2)->create();
    }

    protected function makeModel()
    {
        return ModelDao::factory()->create();
    }

    protected function makeModels()
    {
        return ModelDao::factory(2)->create();
    }

}
