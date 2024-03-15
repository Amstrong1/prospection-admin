<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProspectSolution extends Model
{
    use HasFactory;

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
