<?php

namespace App\Http\Controllers\Api;

use App\Models\Solution;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;

class SolutionController extends Controller
{
    public function index($id) {
        $solutions = Solution::where('structure_id', $id)->get();
        return DataResource::collection($solutions);
    }
}
