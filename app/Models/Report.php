<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $append = [
        'user_name',
        'prospect_name',
        'formatted_created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    public function getUserNameAttribute()
    {
        return $this->user->lastname . ' ' . $this->user->firstname;
    }

    public function getProspectNameAttribute()
    {
        return $this->prospect->lastname . ' ' . $this->prospect->firstname;
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d/m/Y - H:i');
    }
}
