<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use HasFactory, Notifiable, CanResetPassword;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        "name",
        "email",
        "password",
    ];
}
