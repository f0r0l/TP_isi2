<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    // POST /api/register
    public function register(Request $request)
    {
        $fields = $request->validate([
            'nom' => 'required|string|max:50',
            'prenom' => 'required|string|max:50',
            'email' => 'required|string|unique:users,email|max:100',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'nom' => $fields['nom'],
            'prenom' => $fields['prenom'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password'])
        ]);

        // Génération du token d'authentification Sanctum
        $token = $user->createToken('main_token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    // POST /api/login
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Vérification de l'existence de l'utilisateur et du mot de passe
        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::make($fields['password'], $user->password)) {
            return response([
                'message' => 'Identifiants incorrects.'
            ], 401);
        }

        $token = $user->createToken('main_token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    // POST /api/user/logout
    public function logout(Request $request)
    {
        // Supprime le token actuel utilisé pour la requête
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => 'Déconnexion réussie.'
        ], 200);
    }
}