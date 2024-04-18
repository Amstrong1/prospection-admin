<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Suspect;
use App\Models\SolutionSuspect;
use Illuminate\Support\Facades\Auth;

class SuspectController extends Controller
{
    public function index()
    {
        $structure = Auth::user()->structure;
        if (request()->method() == 'POST') {
            $suspects = $structure->suspects()->orderBy('app_date', 'desc');

            if (request()->filled('user_id')) {
                $suspects = $suspects->where('user_id', request()->user_id)
                    ->orderBy('app_date', 'desc');
            }

            if (request()->filled('start') && request()->filled('end') && request()->end > request()->start) {
                $suspects = $suspects->where('created_at', '>=', request()->start)
                    ->where('created_at', '<=', request()->end)
                    ->orderBy('app_date', 'desc');
            }

            $suspects = $suspects->get();
        } else {
            $suspects = $structure->suspects()->orderBy('app_date', 'desc')->get();
        }

        return view('app.suspects.index', [
            'users' => $structure->users()->where('role', 'user')->get(),
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
            // 'name' => 'Nom et prénom',
            'company' => 'Entreprise',
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
