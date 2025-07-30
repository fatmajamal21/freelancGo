<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ForgetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guarded = [];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgetPasswordNotification($token, 'admin'));
    }
}
