<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Info extends Model
{
    use HasFactory;
    protected $table = 'user_info';
    protected $fillable = ['fullname', 'address', 'age', 'phone', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
