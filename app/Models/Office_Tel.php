<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office_Tel extends Model
{
    use HasFactory;
    protected $table = 'office_tel';
    protected $fillable = ['phone', 'office_id'];

    public function office()
    {
        return $this->belongsTo(Office_Tel::class);
    }
}
