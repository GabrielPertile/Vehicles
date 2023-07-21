<?php

namespace App\Modules\Vehicle\Data\Dao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleDao extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $fillable = [
        'description',
        'brand_id',
        'model_id',
        'price',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

}
