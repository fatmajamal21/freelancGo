<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $guard_name = 'admin';
}
