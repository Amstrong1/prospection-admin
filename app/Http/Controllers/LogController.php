<?php

namespace App\Http\Controllers;

use App\Models\UserLocation;

class LogController extends Controller
{
    public function index()
    {
        $logs = UserLocation::where('structure_id', auth()->user()->structure_id)->orderBy('created_at', 'desc')->get();
        return view('app.logs.index', [
            'logs' => $logs,
            'my_attributes' => $this->prospect_columns(),
            'my_actions' => $this->prospect_actions(),
        ]);
    }

    public function map($id)
    {
        $userLocation = UserLocation::find($id);
        $initialMarkers = [
            [
                'position' => [
                    'lat' => $userLocation->latitude,
                    'lng' => $userLocation->longitude
                ],
                'draggable' => false
            ],
        ];
        return view('app.logs.map', compact('initialMarkers'));
    }

    private function prospect_actions()
    {
        $actions = (object) array(
            'map' => 'Voir sur carte',
        );
        return $actions;
    }

    private function prospect_columns()
    {
        $columns = (object) [
            'agent' => 'Nom et prénom',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'address' => 'Adresse',
            'formatted_created_at' => 'Date',
        ];
        return $columns;
    }
}
