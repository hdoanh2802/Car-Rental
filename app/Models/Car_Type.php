<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car_Type extends Model
{
    use HasFactory;
    protected $table = 'car_type';
    protected $fillable = ['label', 'description'];

    public function cars()
    {
        return $this->hasMany(Car::class, 'type_id');
    }
}
