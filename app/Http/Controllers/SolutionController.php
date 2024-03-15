<?php

namespace App\Http\Controllers;

use App\Models\Solution;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\StoreSolutionRequest;
use App\Http\Requests\UpdateSolutionRequest;

class SolutionController extends Controller
{
    public function index()
    {
        return view('app.solutions.index', [
            'solutions' => Solution::all(),
            'my_actions' => $this->solution_actions(),
            'my_attributes' => $this->solution_columns(),
        ]);
    }

    public function create()
    {
        return view('app.solutions.create', [
            'my_fields' => $this->solution_fields()
        ]);
    }

    public function store(StoreSolutionRequest $request)
    {
        $solution = new Solution();

        $solution->title = $request->title;
        $solution->description = $request->description;

        if ($solution->save()) {
            Alert::toast("Opération éffectué avec succès", 'success');
            return redirect('solutions');
        } else {
            Alert::toast("Une erreur est survenue", 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    public function show(Solution $solution)
    {
        return view('app.solutions.show', [
            'solution' => $solution,
            'my_fields' => $this->solution_fields(),
        ]);
    }

    public function edit(Solution $solution)
    {
        return view('app.solutions.edit', [
            'solution' => $solution,
            'my_fields' => $this->solution_fields(),
        ]);
    }

    public function update(UpdateSolutionRequest $request, Solution $solution)
    {        
        $solution->title = $request->title;
        $solution->description = $request->description;

        if ($solution->save()) {
            Alert::toast("Modification éffectuée succès", 'success');
            return redirect('solutions');
        } else {
            Alert::toast("Une erreur est survenue", 'error');
            return back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solution $solution)
    {
        try {
            $solution = $solution->delete();
            Alert::success("Suppression", "Succès");
            return redirect('solutions');
        } catch (\Exception $e) {
            Alert::error("Oops", "Une erreur est survenue",);
            return back();
        }
    }

    private function solution_columns()
    {
        $columns = (object) [
            'title' => 'Libellé',
            'description' => 'Description',
        ];
        return $columns;
    }

    private function solution_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function solution_fields()
    {
        $fields = [
            'title' => [
                'title' => 'Libellé',
                'field' => 'text'
            ],
            'description' => [
                'title' => 'Description',
                'field' => 'textarea'
            ]
        ];
        return $fields;
    }
}
