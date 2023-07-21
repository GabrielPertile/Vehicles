<?php

namespace App\Modules\Vehicle\Data\Dao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleDao extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'description',
        'brand_id',
        'model_id',
        'price',
        'image'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Associations
     */

     protected function brand(): BelongsTo
     {
        return $this->belongsTo(BrandDao::class, 'brand_id');
     }

      protected function model(): BelongsTo
      {
         return $this->belongsTo(ModelDao::class, 'model_id');
      }


}
