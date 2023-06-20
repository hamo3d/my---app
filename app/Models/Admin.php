<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Admin extends   Authenticatable
{
    use HasFactory , HasApiTokens;


    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
        'email_verified_at',
        'remember_token'
    ];
}
