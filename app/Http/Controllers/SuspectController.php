<?php

namespace App\Http\Controllers;

use App\Models\SolutionSuspect;
use App\Models\Suspect;
use App\Models\User;
use Illuminate\Http\Request;

class SuspectController extends Controller
{
    public function index()
    {
        if (request()->method() == 'POST') {
            if (request()->user_id == 'all' && request()->suspect_response == 'all') {
                $suspects = Suspect::all();
            } elseif (request()->user_id != 'all' && request()->suspect_response == 'all') {
                $suspects = Suspect::where('user_id', request()->user_id)->get();
            } elseif (request()->user_id == 'all' && request()->suspect_response != 'all') {
                $suspects = Suspect::where('suspect_response', request()->suspect_response)->get();
            } else {
                $suspects = Suspect::where('user_id', request()->user_id)
                    ->where('suspect_response', request()->suspect_response)
                    ->get();
            }
        } else {
            $suspects = Suspect::all();
        }

        return view('app.suspects.index', [
            'users' => User::where('is_admin', 0)->get(),
            'suspects' => $suspects,
            'my_actions' => $this->suspect_actions(),
            'my_attributes' => $this->suspect_columns(),
        ]);
    }

    public function show(Suspect $suspect)
    {
        return view('app.suspects.show', [
            'suspect' => $suspect,
            'my_fields' => $this->solution_fields($suspect),
        ]);
    }

    private function suspect_columns()
    {
        $columns = (object) [
            'recruiter_name' => 'Agents',
            'name' => 'Nom et prénom',
            // 'company' => 'Entreprise',
            // 'address' => 'Adresse',
            // 'tel' => 'Tel',
            // 'email' => 'Email',
            'solutions' => 'Solutions',
            'app_date' => 'Date RDV',
            'app_time' => 'Heure RDV',
        ];
        return $columns;
    }

    private function suspect_actions()
    {
        $actions = (object) array(
            'show' => 'Voir',
        );
        return $actions;
    }

    private function solution_fields($suspect)
    {
        $suspectSolutions = SolutionSuspect::where('suspect_id', $suspect->id)->get();
        $solutions = [];
        foreach ($suspectSolutions as $suspectSolution) {
            $solutions[] = $suspectSolution->solution->title;
        }

        $fields = [
            'recruiter_name' => [
                'title' => 'Agent',
                'field' => 'text',

            ],
            'lastname' => [
                'title' => 'Nom',
                'field' => 'text'
            ],
            'firstname' => [
                'title' => 'Prénoms',
                'field' => 'text'
            ],
            'company' => [
                'title' => 'Entreprise',
                'field' => 'text'
            ],
            'address' => [
                'title' => 'Adresse',
                'field' => 'address'
            ],
            'tel' => [
                'title' => 'Tel',
                'field' => 'tel'
            ],
            'email' => [
                'title' => 'Email',
                'field' => 'email'
            ],
            'solutions' => [
                'title' => 'Solutions',
                'field' => 'checkbox',
                'options' => $solutions,
            ],
        ];
        return $fields;
    }
}
