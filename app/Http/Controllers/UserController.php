<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Notifications\NewUserNotification;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        return view('app.users.index', [
            'users' => User::where('is_admin', 0)->get(),
            'my_actions' => $this->user_actions(),
            'my_attributes' => $this->user_columns(),
        ]);
    }

    public function create()
    {
        return view('app.users.create', [
            'my_fields' => $this->user_fields()
        ]);
    }

    public function generateRandomCode() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
    
        for ($i = 0; $i < 8; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $code .= $characters[$index];
        }
    
        return $code;
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();

        $code = $this->generateRandomCode();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->address = $request->address;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->password = $code;

        if ($user->save()) {
            $user->notify(new NewUserNotification($code));
            Alert::toast("Opération éffectué avec succès", 'success');
            return redirect('users');
        } else {
            Alert::toast("Une erreur est survenue", 'error');
            return redirect()->back()->withInput($request->input());
        }
    }

    public function show(User $user)
    {
        return view('app.users.show');
    }

    public function edit(User $user)
    {
        return view('app.users.edit', [
            'user' => $user,
            'my_fields' => $this->user_fields(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = User::find($user->id);

        $user->lastname = $request->lastname;
        $user->firstname = $request->firstname;
        $user->tel = $request->tel;
        $user->email = $request->email;
        $user->address = $request->address;

        if ($user->save()) {
            Alert::toast("Modification éffectuée succès", 'success');
            return redirect('users');
        } else {
            Alert::toast("Une erreur est survenue", 'error');
            return back()->withInput($request->input());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user = $user->delete();
            Alert::success("Suppression", "Succès");
            return redirect('users');
        } catch (\Exception $e) {
            Alert::error("Oops", "Une erreur est survenue",);
            return back();
        }
    }

    private function user_columns()
    {
        $columns = (object) [
            'lastname' => 'Nom',
            'firstname' => 'Prénoms',
            'tel' => 'Tel',
            'email' => 'Email',
            'address' => 'Adresse'
        ];
        return $columns;
    }

    private function user_actions()
    {
        $actions = (object) array(
            'edit' => 'Modifier',
            'delete' => "Supprimer",
        );
        return $actions;
    }

    private function user_fields()
    {
        $fields = [
            'lastname' => [
                'title' => 'Nom',
                'field' => 'text'
            ],
            'firstname' => [
                'title' => 'Prénoms',
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
            'address' => [
                'title' => 'Adresse',
                'field' => 'text'
            ]
        ];
        return $fields;
    }
}
