<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;

    protected $append = [
        'formatted_created_at',
        'agent'
    ];

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getAgentAttribute()
    {
        return $this->user->lastname . ' ' . $this->user->firstname;
    }
}
