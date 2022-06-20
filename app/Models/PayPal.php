<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPal extends Model
{
    const STATUS_COMPLETED = 'completed';
    const STATUS_UNCOMPLETED = 'uncompleted';
    
    use HasFactory;
    protected $table = 'paypal';
    protected $fillable = ['booking_id', 'paypal_id', 'description', 'total_paypal', 'user_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
