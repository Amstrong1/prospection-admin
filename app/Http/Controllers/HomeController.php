<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __invoke()
    {
        if (Auth::user()->role == 'admin') {
            $structure = Auth::user()->structure;
            $reports = $structure->reports()->count();
            $solutions = $structure->solutions()->count();
            $prospects = $structure->prospects()->count();
            $suspects = $structure->suspects()->count();
            $users = $structure->users()->where('role', 'user')->count();
            return view('dashboard', compact('users', 'reports', 'solutions', 'prospects', 'suspects'));
        } elseif (Auth::user()->role == 'super_admin') {
            $structures = Structure::all()->count();
            return view('dashboard', compact('structures'));
        }
    }
}
