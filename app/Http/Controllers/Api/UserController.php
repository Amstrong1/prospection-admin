<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\UserLocation;
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

        if (Auth::attempt($credentials) && Auth::user()->deleted_at == null) {
            $response = [
                'success' => true,
                'user_id' => Auth::id(),
                'structure_id' => Auth::user()->structure_id,
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

    public function storeLocation(Request $request)
    {
        $location = new UserLocation();
        $location->user_id = $request->user_id;
        $location->structure_id = $request->structure_id;
        $location->longitude = $request->longitude;
        $location->latitude = $request->latitude;
        $location->address = $request->address;
        $location->save();
    }
}
