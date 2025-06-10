<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory; 

    protected $fillable = [
        'full_name',
        'username',
        'email',
        'password',
        'phone',
        'whatsapp_number',
        'address',
        'user_image',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
}

