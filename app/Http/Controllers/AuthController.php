<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\MedicalCard;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Kreait\Firebase;
use Lcobucci\JWT\Token\InvalidTokenStructure;

// use Kreait\Firebase\Auth;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login','register']]);
    }



    // Login user
    public function login(Request $request){

        $validated_data = $request->validate([
            'phone' => "required|string:8",
            'password' => "required|string|min:8"
        ]);

        if(Auth::attempt(['phone' => $validated_data['phone'], 'password' => $validated_data['password']]))
        {

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
            $token = $user->createToken('secret')->plainTextToken;


            Log::info($user);
            // dd($token);
            // $cookie = cookie('jwt', $token, 60*24);
            // return response(["message" => "Success"])->withCookie($cookie);


            if (Gate::allows('patient')) {
                $medical_card = MedicalCard::where('user_id', $user->id)->first();
                if (!empty($medical_card)) {
                    return response()->json([
                    "status" => "success",
                    "type" => "patient",
                    "user" => $user,
                    "medical_card_pdf" => $medical_card->medical_card_pdf,
                    "my_unique_medical_card_token" => $medical_card->unique_token,
                    "token" => $token,
                ], 200);
                } else {
                    return response()->json([
                        "status" => "success",
                        "type" => "patient",
                        "user" => $user,
                        "token" => $token,
                    ], 200);
                }
            }


            if(Gate::allows('doctor'))
            {
                return response()->json([
                    "status" => "success",
                    "type" => "doctor",
                    "user" => $user,
                    "token" => $token,
                ], 200);
            }

            // if(Gate::allows('admin'))
            // {
            //     return response()->json([
            //         "status" => "success",
            //         "type" => "admin",
            //         "user" => $user,
            //         "token" => $token,
            //     ], 200);
            // }



            // return response()->json([
            //     "status" => "success",
            //         "type" => "doctor",
            //     "user" => $user,
            //     "token" => $token,
            // ], 200);
            # code...
        }

        else 
        {
            return response()->json([
                "status" => "error",
                "message" => "identifiants invalide!",
            ], 403);
        }

    }


    // Get user details
    public function user() {

          
        $user_array = array();
        $users = User::all();
        $doctors = Doctor::all();
        $doctors_array = [];

        foreach ($users as $user) {
            // if($user->doctor != null)
            // {
            //     $doctors[] = $user;
            // }
            foreach ($doctors as $doctor) {
                if($user->id == $doctor->user_id)
                {
                    $doctors_array['doc_name'] = $user->first_name." ".$user->last_name;
                    $doctors_array['doc_profile'] = $doctor->id_card;
                }
            }
        }

        $user_array['doctor'] = $doctors_array; 
        return response()->json([
            $user_array
        ], 200);



        return response()->json([
            // 'status' => 'success',
            'message' => 'No user found',
        ],401);

    }

    // Logout authenticated user
    public function logout(){
        $user = Auth::user();
        $user()->tokens()->delete();

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
