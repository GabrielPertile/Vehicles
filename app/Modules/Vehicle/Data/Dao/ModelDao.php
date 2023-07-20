<?php

namespace App\Modules\Vehicle\Data\Dao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelDao extends Model
{
    use HasFactory;

    protected $table = 'models';

    protected $fillable = [
        'name',
        'brand_id'
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
}
