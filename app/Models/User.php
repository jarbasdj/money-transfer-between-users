<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    public const TYPE_CUSTOMER = 'customer';
    public const TYPE_STORE = 'store';

    protected $fillable = [
        'name',
        'email',
        'document',
        'type',
        'balance',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
