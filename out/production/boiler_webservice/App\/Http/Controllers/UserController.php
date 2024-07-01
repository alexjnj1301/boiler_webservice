<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'pseudo' => 'required'
        ], [
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'L\'adresse email doit être valide.',
            'password.required' => 'Le mot de passe est requis.',
            'pseudo.required' => 'Le pseudo est requis.'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token', ['expires_in' => 7200])->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'firstName' => $user->firstName,
                    'lastName' => $user->lastName,
                    'email' => $user->email,
                    'city' => $user->city
                ]
            ]);

        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    // create a new user
    public function register(Request $request){
        try {
            $request->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email|unique:users,email',
                'city' => 'required',
                'password' => 'required|min:6'
            ], [
                'firstName.required' => 'Le champ prénom est requis.',
                'lastName.required' => 'Le champ nom est requis.',
                'email.required' => 'Le champ email est requis.',
                'email.email' => 'L\'adresse email doit être valide.',
                'email.unique' => 'L\'adresse email est déjà utilisée.',
                'city.required' => 'Le champ city est requis.',
                'password.required' => 'Le mot de passe est requis.',
                'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.'
            ]);

            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email'=> $request->email,
                'city' => $request->city,
                'password' => bcrypt($request->password)
            ]);

            $token = $user->createToken('auth_token', ['expires_in' => 7200])->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => [
                    'id' => $user->id,
                    'firstName' => $user->firstName,
                    'lastName' => $user->lastName,
                    'email' => $user->email,
                    'city' => $user->city
                ]
            ]);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->validator->errors()], 422);
        }
    }
}
