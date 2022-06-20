<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    const RENTA_TYPE_SHORT = 'Short-term';
    const RENTA_TYPE_LONG = 'Long-term';
    const RENTA_TYPE = [Booking::RENTA_TYPE_SHORT, Booking::RENTA_TYPE_LONG];

    use HasFactory;
    protected $table = 'booking';
    protected $fillable = ['user_id', 'car_id', 'pick_up_date', 'return_date', 'pick_up_office_id', 'return_office_id', 'status', 'retal_type'];

    public function pick_up_office()
    {
        return $this->belongsTo(Office::class);
    }

    public function return_office()
    {
        return $this->belongsTo(Office::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function status()
    {
        return $this->belongsTo(StatusBooking::class);
    }

    public function paypal()
    {
        return $this->hasMany(PayPal::class);
    }
}
