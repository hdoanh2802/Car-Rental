<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandCar extends Model
{
    use HasFactory;
    protected $table = 'brand_car';
    protected $fillable = ['name_brand'];

    public function cars()
    {
        return $this->hasMany(Car::class, 'brand_id');
    }
}
