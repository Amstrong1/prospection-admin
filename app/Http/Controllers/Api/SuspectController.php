<?php

namespace App\Http\Controllers\Api;

use App\Models\Suspect;
use Illuminate\Http\Request;
use App\Models\SolutionSuspect;
use App\Http\Controllers\Controller;
use App\Http\Resources\DataResource;
use App\Http\Requests\ProspectRequest;

class SuspectController extends Controller
{
    public function index($id)
    {
        $suspects = Suspect::where('user_id', $id)->with('solutions')->orderBy('id', 'desc')->get();
        return DataResource::collection($suspects);
    }

    public function store(ProspectRequest $request)
    {
        $suspect = new Suspect();
        $suspect->structure_id =  $request->user_structure;
        $suspect->user_id = $request->user;
        $suspect->firstname = $request->firstname;
        $suspect->lastname = $request->lastname;
        $suspect->company = $request->company;
        $suspect->address = $request->address;
        $suspect->tel = $request->tel;
        $suspect->email = $request->email;
        $suspect->app_date = $request->app_date;
        $suspect->app_time = $request->app_time;

        if ($suspect->save()) {
            $solutions = json_decode($request->solutions);
            foreach ($solutions as $value) {
                $suspectSolution = new SolutionSuspect();
                $suspectSolution->suspect_id = $suspect->id;
                $suspectSolution->solution_id = $value;
                $suspectSolution->save();
            }
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
        $suspect = Suspect::find($id);
        return new DataResource($suspect);
    }

    public function update(ProspectRequest $request, $id)
    {
        $suspect = Suspect::find($id);
        $suspect->firstname = $request->firstname;
        $suspect->lastname = $request->lastname;
        $suspect->address = $request->address;
        $suspect->tel = $request->tel;
        $suspect->email = $request->email;

        if ($suspect->save()) {
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

    public function destroy($id)
    {
        try {
            $suspectSolutions = SolutionSuspect::where('suspect_id', $id)->get();
            foreach ($suspectSolutions as $suspectSolution) {
                $suspectSolution->delete();
            }
            $suspect = Suspect::find($id);
            $suspect->delete();
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
