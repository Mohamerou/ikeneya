<?php

namespace App\Http\Controllers;

use App\Models\User;
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


    // // Register new user
    // public function register(Request $request) {
    //     $validated_data = $request->validate([
    //         'first_name' => "required|String|min:3|max:255",
    //         'last_name' => "required|String|min:3|max:255",
    //         'phone' => "required|string|min:8|max:8",
    //         'address' => "required|string"
    //     ]);

    //     $new_user = User::create([
    //         'first_name' => $validated_data['first_name'],
    //         'last_name' => $validated_data['last_name'],
    //         'phone' => $validated_data['phone'],
    //         'address' => $validated_data['address']
    //     ]);

    //     if(!is_null($new_user)) {
    //         // $random_password = Hash::make(Str::random(9));
    //         $random_password = Hash::make("password");
    //         $new_user->password = $random_password;
    //         $new_user->save();

    //         return response()->json([
    //             'user'      => $new_user,
    //             'token'     => $new_user->createToken('secret')->plainTextToken
    //         ], Response::HTTP_ACCEPTED);
    //     }

    //     return response()->json(["message" => "Un problème est survenu lors de l'enregistrement"], 404);
    // }


    // Login user
    public function login(Request $request){
        $validated_data = $request->validate([
            'phone' => "required|string:8",
            'password' => "required|string|min:8"
        ]);



            // Log::info($request->all());

        // print_r($validated_data);

        // $auth = app('firebase.auth');

        // // Retrieve the Firebase credential's token
        // $idTokenString = $request->input('Firebasetoken');


        // try { // Try to verify the Firebase credential token with Google

        //     $verifiedIdToken = $auth->verifyIdToken($idTokenString);

        // } catch (\InvalidArgumentException $e) { // If the token has the wrong format

        //     return response()->json([
        //         'message' => 'Unauthorized - Can\'t parse the token: ' . $e->getMessage()
        //     ], 401);

        // } catch (InvalidTokenStructure $e) { // If the token is invalid (expired ...)

        //     return response()->json([
        //         'message' => 'Unauthorized - Token is invalide: ' . $e->getMessage()
        //     ], 401);

        // }

        // // Retrieve the UID (User ID) from the verified Firebase credential's token
        // $uid = $verifiedIdToken->getClaim('sub');

        // // Retrieve the user model linked with the Firebase UID
        // $user = User::where('firebaseUID',$uid)->first();

        // // Here you could check if the user model exist and if not create it
        // // For simplicity we will ignore this step

        // // Once we got a valid user model
        // // Create a Personnal Access Token
        // $tokenResult = $user->createToken('Personal Access Token');

        // // Store the created token
        // $token = $tokenResult->token;

        // // Add a expiration date to the token
        // $token->expires_at = Carbon::now()->addWeeks(1);

        // // Save the token to the user
        // $token->save();

        // // Return a JSON object containing the token datas
        // // You may format this object to suit your needs
        // return response()->json([
        //     'id' => $user->id,
        //     'access_token' => $tokenResult->accessToken,
        //     'token_type' => 'Bearer',
        //     'expires_at' => Carbon::parse(
        //     $tokenResult->token->expires_at
        //     )->toDateTimeString()
        // ]);


        Log::info($request->all());
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
        }


        return response()->json([
            "status" => "error",
            "message" => "identifiants invalide!",
        ], 403);
    }


    // Get user details
    public function user() {

        $user = Auth::user();

        if (!empty($user)) {
                return response()->json([
                    'user' => $user,
                ],200);
        }

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
