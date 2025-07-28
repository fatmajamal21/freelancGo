<?php

namespace App\Models;

use App\Notifications\ForgetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Freelancer extends Authenticatable
{
    use Notifiable;
    protected $guarded = [];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgetPasswordNotification($token, 'freelancer'));
    }
}
