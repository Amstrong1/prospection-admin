<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Structure;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'lastname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'structure_email' => ['required', 'string', 'lowercase', 'email', 'max:255',],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $structure = Structure::where('email', $request->structure_email)->first();

        if ($structure !== null) {
            $user = User::create([
                'lastname' => $request->lastname,
                'firstname' => $request->firstname,
                'structure_id' => $structure->id,
                'role' => 'admin', 
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            event(new Registered($user));
    
            Auth::login($user);
    
            return redirect(route('dashboard', absolute: false));
        } else {
            Alert::toast('Structure non trouvée', 'Vérifier l\'adresse de l\'entreprise');
            return back();
        }
        
    }
}
