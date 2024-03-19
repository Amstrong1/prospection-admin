<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use App\Models\Suspect;
use App\Models\Prospect;
use App\Models\Solution;

class HomeController extends Controller
{
    public function __invoke()
    {
        $reports = Report::count();
        $solutions = Solution::count();
        $prospects = Prospect::count();
        $suspects = Suspect::count();
        $users = User::where('is_admin', false)->count();
        return view('dashboard', compact('users', 'reports', 'solutions', 'prospects', 'suspects'));
    }
}
