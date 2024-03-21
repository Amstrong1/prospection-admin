<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prospect;
use App\Models\ProspectSolution;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->method() == 'POST') {
            if (request()->user_id == 'all') {
                $prospects = Prospect::all();
            } else {
                $prospects = Prospect::where('user_id', request()->user_id)->get();
            }
            
        } else {
            $prospects = Prospect::all();
        }

        return view('app.prospects.index', [
            'users' => User::where('is_admin', 0)->get(),
            'prospects' => $prospects,
            'my_actions' => $this->prospect_actions(),
            'my_attributes' => $this->prospect_columns(),
        ]);
    }

    public function show(Prospect $prospect)
    {
        return view('app.prospects.show', [
            'prospect' => $prospect,
            'my_fields' => $this->solution_fields($prospect),
        ]);
    }

    private function prospect_columns()
    {
        $columns = (object) [
            'recruiter_name' => 'Agents',
            'name' => 'Nom et prénom',
            'solutions' => 'Solutions',
            'status' => 'Reponse',
            'formatted_created_at' => 'Date',
        ];
        return $columns;
    }

    private function prospect_actions()
    {
        $actions = (object) array(
            'show' => 'Voir',
        );
        return $actions;
    }

    private function solution_fields($prospect)
    {
        $prospectSolutions = ProspectSolution::where('prospect_id', $prospect->id)->get();
        $solutions = [];
        foreach ($prospectSolutions as $prospectSolution) {
            $solutions[] = $prospectSolution->solution->title;
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
