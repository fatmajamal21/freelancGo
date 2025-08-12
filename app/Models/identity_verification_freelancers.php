<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class identity_verification_freelancers extends Model
{
    use HasFactory;
    // IdentityVerificationUser.php
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // App\Models\IdentityVerificationFreelancer.php

    public function freelancer()
    {
        return $this->belongsTo(Freelancer::class);
    }
}
