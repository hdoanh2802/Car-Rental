<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const STATUS_DEACTIVATED = 'deactive';
    const STATUS_ACTIVATED = 'active';
    const VERIFIED = 1;
    const STATUS = [User::STATUS_ACTIVATED, User::STATUS_DEACTIVATED];
    const ROLE = [User::ROLE_ADMIN, User::ROLE_USER];
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'password',
        'status',
        'google_id',
        'is_verified',
        'role'
    ];
    protected $guard = ['users'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Turn the password into a hashed password.
     */
    public function hashPassword()
    {
        $hashedPassword = Hash::make($this->password);
        $this->password = $hashedPassword;
    }

    /**
     * Check if the inputed password is correct.
     * 
     * @param password input password
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function userInfo()
    {
        return $this->hasOne(User_Info::class, 'user_id');
    }

    public function paypal()
    {
        return $this->hasMany(PayPal::class, 'user_id');
    }
}
