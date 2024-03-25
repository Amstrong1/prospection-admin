<?php

namespace App\Http\Controllers;

use App\Models\Structure;
use Illuminate\Http\Request;
use App\Mail\NewStructureMail;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreStructureRequest;
use App\Http\Requests\UpdateStructureRequest;

class StructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('app.structure.index', [
            'structures' => Structure::all(),
            'my_actions' => $this->structure_actions(),
            'my_attributes' => $this->structure_columns(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('app.structure.create', [
            'my_fields' => $this->structure_fields()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStructureRequest $request)
    {
        $structure = new Structure();

        $fileName = time() . '.' . $request->logo->extension();
        $path = $request->file('logo')->storeAs('logos', $fileName, 'public');

        $structure->name = $request->name;
        $structure->address = $request->address;
        $structure->tel = $request->tel;
        $structure->email = $request->email;
        $structure->logo = $path;

        if ($structure->save()) {
            Mail::to($request->email)->send(new NewStructureMail());
            Alert::toast("Opération éffectué avec succès", 'success');
            return redirect('structures');
        } else {
            Alert::toast("Une erreur est survenue", 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Structure $structure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Structure $structure)
    {
        return view('app.structure.edit', [
            'structure' => $structure,
            'my_fields' => $this->structure_fields(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStructureRequest $request, Structure $structure)
    {
        $structure = Structure::find($structure->id);

        if ($request->file !== null) {
            $fileName = time() . '.' . $request->logo->extension();
            $path = $request->file('logo')->storeAs('logos', $fileName, 'public');
        }

        if ($request->email !== null && $structure->email !== $request->email) {
            validator(['email' => $request->email])->validate();
            $validator = Validator::make($request->email, [
                'email' => 'required|email|unique:users,email',
            ]);
        }

        $structure->name = $request->name;
        $structure->address = $request->address;
        $structure->tel = $request->tel;
        if ($validator) {
            $structure->email = $request->email;
        }

        if (isset($path)) {
            $structure->logo = $path;
        }

        if ($structure->save()) {
            Alert::toast("Modification éffectuée succès", 'success');
            return redirect('structures');
        } else {
            Alert::toast("Une erreur est survenue", 'error');
            return back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Structure $structure)
    {
        try {
            $structure = $structure->delete();
            Alert::success("Suppression", "Succès");
            return redirect('structures');
        } catch (\Exception $e) {
            Alert::error("Oops", "Une erreur est survenue",);
            return redirect()->back();
        }
    }

    private function structure_columns()
    {
        $columns = (object) [
            'logo' => '',
            'name' => 'Dénomination',
            'tel' => 'Contact',
            'email' => 'Email',
            'address' => 'Adresse',
        ];
        return $columns;
    }

    private function structure_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function structure_fields()
    {
        $fields = [
            'name' => [
                'title' => 'Dénomination',
                'field' => 'text'
            ],
            'address' => [
                'title' => 'Adresse',
                'field' => 'text'
            ],
            'tel' => [
                'title' => 'Contact',
                'field' => 'tel'
            ],
            'email' => [
                'title' => 'Email',
                'field' => 'email'
            ],
            'logo' => [
                'title' => 'Logo',
                'field' => 'file'
            ],
        ];
        return $fields;
    }
}
