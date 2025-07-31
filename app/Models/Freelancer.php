<?php

namespace App\Models;

use App\Notifications\ForgetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class Freelancer extends Authenticatable
{
    use Notifiable, HasRoles;
    protected $guarded = [];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgetPasswordNotification($token, 'freelancer'));
    }
}
