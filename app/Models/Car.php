<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $table = 'cars';
    protected $fillable = ['color', 'brand_id', 'description', 'purch_date', 'name', 'type_id', 'office_id', 'image_path'];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function type()
    {
        return $this->belongsTo(Car_Type::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'car_id');
    }

    public function brand()
    {
        return $this->belongsTo(BrandCar::class);
    }
}
