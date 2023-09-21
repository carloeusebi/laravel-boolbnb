<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json($user);
        }

        return response()->json(['errors' => 'invalid-credentials'], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'email|required|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(8)],
            'first_name' => 'nullable|max:30',
            'last_name' => 'nullable!max:30',
            'birthday' => 'nullable|date'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        Auth::login($user);

        return response()->json($user);
    }

    public function logout()
    {
        Auth::logout();
        return response(status: 204);
    }
}
