<?php

namespace App\Http\Controllers\Api;

use App\Models\Solution;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;

class SolutionController extends Controller
{
    public function index() {
        $solutions = Solution::all();
        return DataResource::collection($solutions);
    }
}
