<?php

namespace App\Modules\Vehicle\Data\Dao;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Vehicle\Data\Dao\ModelDao;
use App\Modules\Vehicle\Data\Dao\VehicleDao;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BrandDao extends Model
{
    use HasFactory;

    protected $table = "brands";

    protected $fillable = [
        'name'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Associations
     */

     protected function models(): HasMany
     {
        return $this->hasMany(ModelDao::class, 'brand_id');
     }

     protected function vehicles(): HasMany
     {
        return $this->hasMany(VehicleDao::class, 'model_id');
     }
}
