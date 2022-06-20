<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $table = 'office';
    protected $fillable = ['name', 'address'];

    public function office()
    {
        return $this->hasMany(Office_Tel::class, 'office_id');
    }

    public function car()
    {
        return $this->hasMany(Car::class, 'office_id');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'id', 'pick_up_office_id');
    }
}
