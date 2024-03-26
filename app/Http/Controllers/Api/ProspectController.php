<?php

namespace App\Http\Controllers\Api;

use App\Models\Report;
use App\Models\Suspect;
use App\Models\Prospect;
use Illuminate\Http\Request;
use App\Models\SolutionSuspect;
use App\Models\ProspectSolution;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use App\Http\Requests\ProspectRequest;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $prospects = Prospect::where('user_id', $id)->with('solutions')->with('reports')->orderBy('id', 'desc')->get();
        return DataResource::collection($prospects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProspectRequest $request)
    {
        $prospect = new Prospect();

        $prospect->structure_id =  $request->user_structure;
        $prospect->user_id = $request->user;
        $prospect->firstname = $request->firstname;
        $prospect->lastname = $request->lastname;
        $prospect->company = $request->company;
        $prospect->address = $request->address;
        $prospect->tel = $request->tel;
        $prospect->email = $request->email;
        $prospect->app_date = $request->app_date;
        $prospect->app_time = $request->app_time;
        $prospect->status = $request->status;

        if ($prospect->save()) {
            if ($request->report !== null) {
                $report = new Report();
                $report->structure_id = $prospect->structure_id;
                $report->prospect_id = $prospect->id;
                $report->user_id = $request->user;
                $report->report = $request->report;
                $report->save();
            }

            $solutions = json_decode($request->solutions);
            foreach ($solutions as $value) {
                $prospectSolution = new ProspectSolution();
                $prospectSolution->prospect_id = $prospect->id;
                $prospectSolution->solution_id = $value;
                $prospectSolution->save();
            }
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeFromSuspect(Request $request)
    {
        $suspect = Suspect::find($request->suspect);

        $prospect = new Prospect();
        $prospect->structure_id = $suspect->structure_id;
        $prospect->user_id = $suspect->user_id;
        $prospect->firstname = $suspect->firstname;
        $prospect->lastname = $suspect->lastname;
        $prospect->company = $suspect->company;
        $prospect->address = $suspect->address;
        $prospect->tel = $suspect->tel;
        $prospect->email = $suspect->email;
        $prospect->app_date = $request->app_date;
        $prospect->app_time = $request->app_time;
        $prospect->status = $request->status;

        if ($prospect->save()) {

            if ($request->report !== null) {
                $report = new Report();
                $report->structure_id = $prospect->structure_id;
                $report->prospect_id = $prospect->id;
                $report->user_id = $request->user;
                $report->report = $request->report;
                $report->save();
            }

            $solutions = SolutionSuspect::where('suspect_id', $prospect->id)->get();
            foreach ($solutions as $solution) {
                $prospectSolution = new ProspectSolution();
                $prospectSolution->prospect_id = $solution->id;
                $prospectSolution->solution_id = $solution->id;
                $prospectSolution->save();
            }
            $suspect->delete();
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prospect = Prospect::find($id);
        return new DataResource($prospect);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProspectRequest $request, $id)
    {
        $prospect = Prospect::find($id);
        $prospect->firstname = $request->firstname;
        $prospect->lastname = $request->lastname;
        $prospect->address = $request->address;
        $prospect->tel = $request->tel;
        $prospect->email = $request->email;

        if ($prospect->save()) {
            $response = [
                'success' => true,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $prospectSolutions = ProspectSolution::where('prospect_id', $id)->get();
            foreach ($prospectSolutions as $prospectSolution) {
                $prospectSolution->delete();
            }

            $reports = Report::where('prospect_id', $id)->delete();
            foreach ($reports as $report) {
                $report->delete();
            }
            $prospect = Prospect::find($id);
            $prospect->delete();

            $response = [
                'success' => true,
            ];
        } catch (\Exception $e) {
            $response = [
                'success' => false,
            ];
        }
        return $response;
    }
}
