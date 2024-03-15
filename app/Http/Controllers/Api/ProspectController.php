<?php

namespace App\Http\Controllers\Api;

use App\Models\Prospect;
use Illuminate\Http\Request;
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
        $prospects = Prospect::where('user_id', $id)->get();
        return DataResource::collection($prospects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProspectRequest $request)
    {
        $prospect = new Prospect();
        $prospect->user_id = $request->user;
        $prospect->firstname = $request->firstname;
        $prospect->lastname = $request->lastname;
        $prospect->company = $request->company;
        $prospect->address = $request->address;
        $prospect->tel = $request->tel;
        $prospect->email = $request->email;

        if ($prospect->save()) {
            $prospectSolution = new ProspectSolution();
            $prospectSolution->prospect_id = $prospect->id;
            $prospectSolution->solution_id = $request->solution;
            $prospectSolution->save();
            
            $response = 'success';
        } else {
            $response = 'error';
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
            $prospect = Prospect::find($id);
            $prospect->delete();
            return 'success';
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
