<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials) && Auth::user()->active) {
            $response = [
                'success' => true,
                'user_id' => Auth::id(),
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }

        return response()->json($response);
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::find($request->user);
        $response = [];

        if ($user !== null && Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            $response = [
                'success' => true,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }

        return response()->json($response);
    }

    public function userData($id)
    {
        $user = User::find($id);
        $response = [
            'name' => $user->lastname . ' ' . $user->firstname,
            'email' => $user->email,
        ];

        return response()->json($response);
    }
}
