<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class identity_verification_users extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'id_card_number',
        'front_image',
        'selfie_image',
        'status',
        'reviewed_at',
        'reviewed_by',
        'rejection_reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
