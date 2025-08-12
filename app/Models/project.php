<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proposal;


class project extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'budget',
        'duration',
        'deadline',
        'status',
    ];


    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'open' => 'مفتوح',
            'in_progress' => 'قيد التنفيذ',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            default => $this->status,
        };
    }
    public function proposals()
    {
        return $this->hasMany(proposals::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
