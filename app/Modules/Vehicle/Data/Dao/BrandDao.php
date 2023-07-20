<?php

namespace App\Modules\Vehicle\Data\Dao;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
