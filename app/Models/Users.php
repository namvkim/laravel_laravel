<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;

class Users extends User
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['email', 'address', 'full_name', 'phone', 'password', 'level'];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
