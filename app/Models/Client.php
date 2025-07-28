<?php

namespace App\Models;

use App\Notifications\ForgetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ForgetPasswordNotification($token, 'client'));
    }
}
