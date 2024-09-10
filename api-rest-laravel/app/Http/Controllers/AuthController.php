<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            //définition des règles de validation
            $validateUser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required'
                ]
            );
            //gestion de l'erreur de validation
            if ($validateUser->fails()) {
                return response()->json([
                    'status ' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }
            //si validation ok création du user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);
            //réponse renvoyée au front
            return response()->json([
                'status ' => true,
                'message' => 'user create successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
                //création du token dans la table personal_access_token
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status ' => false,
                'message' => $th->getMessage(),
            ], 500); //renvoie une erreur 500 si
        }
    }

    public function login(Request $request)
    {
        // $request->validate([
        // 'email' => 'required|string|email',
        // 'password' => 'required|string',
        // ]);
        $validateUser = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
        if ($validateUser->fails()) {
            return response()->json([
                'status ' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }
        //on recherche le premier utilisateur par rapport à l'email
        $user = User::where('email', $request->email)->first();
        //on teste le mot de passe par rapport à celui de l'utilisateur
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return response()->json([
                'status ' => false,
                'message' => 'Email or Password dont match',
            ], 401);
        }
        //création d'un token de connexion
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => true,
            "message" => 'user logged successfully',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function me(Request $request)
    {
        $userData = auth()->user();
        return response()->json([
            'status ' => true,
            'message' => 'profile information',
            'data' => $userData,
            'id' => auth()->user()->id
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
