<?php

namespace App\Http\Controllers\Api;

use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $reports = Report::where('user_id', $id)->orderBy('id', 'desc')->get();
        return DataResource::collection($reports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => ['required'],          
            'prospect' => ['required'],          
            'report' => ['required', 'string'],          
        ]);

        $report = new Report();
        $report->structure_id =  $request->user_structure;
        $report->user_id = $request->user;
        $report->prospect_id = $request->prospect;
        $report->report = $request->report;
        
        if ($report->save()) {
            $response = 'success';
        } else {
            $response = 'error';
        }    
        
        return $response;
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $prospect = Report::find($id);
    //     return new DataResource($prospect);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        $report->prospect = $request->prospect;
        $report->report = $request->report;

        if ($report->save()) {
            $response = 'success';
        } else {
            $response = 'error';
        }    
        
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $report = Report::find($id);
            $report->delete();
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
