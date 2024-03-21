<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Structure extends Model
{
    use HasFactory;
    
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    
    public function solutions(): HasMany
    {
        return $this->hasMany(Solution::class);
    }
    
    public function suspects(): HasMany
    {
        return $this->hasMany(Suspect::class);
    }
    
    public function prospects(): HasMany
    {
        return $this->hasMany(Prospect::class);
    }
    
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }
}
