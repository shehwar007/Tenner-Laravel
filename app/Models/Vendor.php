<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Vendor extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'vendor';
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'logo',
        'phone',
        'account_status',
        'address',
        'status',
        'longitude',
        'latitude',
        'verify_token',
    ];

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
        'password' => 'hashed',
    ];


    public function loginSecurity()
    {
        return $this->hasOne(LoginSecurity::class);
    }

    public function EventOffer()
    {
        return $this->hasOne(EventOffer::class)->latest();
    }


    public function hasCompletedGoogle2fa()
    {
        return !empty($this->google2fa_secret);
    }
}