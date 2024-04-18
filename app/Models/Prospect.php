<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    protected $append = ['name', 'recruiter_name', 'solutions', 'formatted_created_at', 'report']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function solutions()
    {
        return $this->belongsToMany(Solution::class, 'prospect_solutions');
    } 

    public function reports()
    {
        return $this->hasMany(Report::class, 'prospect_id')->orderBy('id', 'desc');
    } 

    public function getNameAttribute()
    {
        return $this->lastname . ' ' . $this->firstname;
    }

    public function getRecruiterNameAttribute()
    {
        return $this->user->lastname . ' ' . $this->user->firstname;
    }

    public function getSolutionsAttribute()
    {
        $solutions = [];
        $getSolutions = $this->solutions()->get();
        foreach ($getSolutions as $getSolution) {
            $solutions[] = $getSolution->title;
        }
        return $solutions;
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d/m/Y - H:i');
    }

    public function getReportAttribute()
    {
        return $this->reports()->first()->report ?? "Aucun rapport";
    }   
}
