<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ForgetPasswordNotification;
use Spatie\Permission\Traits\HasRoles;


class Client extends Authenticatable implements CanResetPassword
{
    use Notifiable, HasRoles;

    protected $guarded = [];

    public function sendPasswordResetNotification($token)
    {
        // تعديل هنا لنقل التوكن عبر الإيميل
        $this->notify(new ForgetPasswordNotification($token, 'client'));
    }
}
