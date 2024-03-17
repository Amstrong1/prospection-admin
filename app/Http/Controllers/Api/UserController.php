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

        if (Auth::attempt($credentials)) {
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::where('email', $request->email)->first();
        $response = [];

        if ($user !== null) {
            $user->password = Hash::make($request->password);
        }

        if ($user->save()) {
            $response = [
                'success' => true,
                'user_id' => $user->id,
            ];
        } else {
            $response = [
                'success' => false,
            ];
        }

        return response()->json($response);
    }
}
