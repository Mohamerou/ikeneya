<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    // Register new user
    public function register(Request $request) {
        $validated_data = $request->validate([
            'first_name' => "required|String|min:3|max:255",
            'last_name' => "required|String|min:3|max:255",
            'phone' => "required|digits:8",
            'password' => "required|String"
        ]);

        $new_user = User::create([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'phone' => $validated_data['phone'],
            'password' => Hash::make($validated_data['password'])
        ]);

        if(!is_null($new_user)) {
            return response($new_user, Response::HTTP_ACCEPTED);
        }

        return response()->json(["message" => "Un problème est survenu lors de l'enregistrement"], 404);
    }


    // Login user
    public function login(Request $request){
        // return response()->json([
        //     "request" => $request->all()
        // ]);
        $request->validate([
            'phone' => "required|digits:8",
            'password' => "required|String"
        ]);


        // !Auth::attempt(['email' => $validated_data['email'], 'password' => $validated_data['password']]));
        $credentials = $request->only('phone', 'password');
        $token = Auth::attempt($credentials);

        if(!$token)
        {
            return response()->json([
                    "status" => "error",
                    "message" => "Identifiants invalides"
                ],
                Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        // $token = $user->createToken('token')->plainTextToken;

        // $cookie = cookie('jwt', $token, 60*24);
        // return response(["message" => "Success"])->withCookie($cookie);

        return response()->json([
            "status" => "success",
            "user" => $user,
            "authorization" => [
                'token' => $token,
                'type'  => 'bearer',
            ],
        ]);
    }


    // Get user
    public function user() {
        return response()->json([
            "status" => 'success',
            "user" => Auth::user(),
        ]);
    }

    // Logout authenticated user
    public function logout(){
        // return response()->json(["request->all()"]);
        Auth::logout();

         return response()->json([
            "status" => "success",
            "message" => "Deconnecté avec succès"
        ]);
    }


    public function refresh()
    {
        // return $this->generateToken(auth()->refresh());
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }


    /**
     * Generate token
    */
    protected function generateToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ]);
    }
}
