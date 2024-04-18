<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use App\Models\ProspectSolution;
use Illuminate\Support\Facades\Auth;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $structure = Auth::user()->structure;
        if (request()->method() == 'POST') {
            $prospects = $structure->prospects()->orderBy('app_date', 'desc');

            if (request()->filled('suspect_response')) {
                $prospects = $prospects->where('status', request()->suspect_response)
                    ->orderBy('app_date', 'desc');
            }

            if (request()->filled('user_id')) {
                $prospects = $prospects->where('user_id', request()->user_id)
                    ->orderBy('app_date', 'desc');
            }

            if (request()->filled('start') && request()->filled('end') && request()->end > request()->start) {
                $prospects = $prospects->where('created_at', '>=', request()->start)
                    ->where('created_at', '<=', request()->end)
                    ->orderBy('app_date', 'desc');
            }

            $prospects = $prospects->get();
        } else {
            $prospects = $structure->prospects()->orderBy('app_date', 'desc')->get();
        }

        return view('app.prospects.index', [
            'users' => $structure->users()->where('role', 'user')->get(),
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
            // 'name' => 'Nom et prénom',
            'company' => 'Entreprise',
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

        if (request()->routeIs('prospects.show')) {
            $fields['report'] = [
                'title' => 'Rapport',
                'field' => 'textarea',
            ];
        }
        return $fields;
    }
}
