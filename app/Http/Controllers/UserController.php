<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return response()->json([
            'status'    => 'success',
            'users'  => User::all()
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = new Request();
        $request->request->add(['id' => $id]); //add request

        $validated_data = $request->validate([
            'id' => "required|numeric"
        ]);

        $user = User::find($validated_data['id']);
        if(!is_null($user))
        {
            return response()->json([
                                        "status" => "success",
                                        "user" => $user
                                    ], 200);
        }

        return response()->json(null, 404);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated_data = $request->validate([
            'first_name' => "required|String|min:3|max:255",
            'last_name' => "required|String|min:3|max:255",
            'phone' => "required|email",
            'password' => "required|String"
        ]);

        $new_user = User::create([
            'name' => $validated_data['name'],
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password'])
        ]);

        if(!is_null($new_user)) {
            return response([
                                "status" => "success",
                                "user" => $new_user
                            ], 200);
        }

        return response()->json(["message" => "Un problème est survenu lors de l'enregistrement"], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated_data = $request->validate([
            'first_name' => "required|String|min:3|max:255",
            'last_name' => "required|String|min:3|max:255",
            'phone' => "required|digits:8",
        ]);


        $user = User::find($id);

        if(!is_null($user)) {

            $user->update([
                    'first_name' => $validated_data['first_name'],
                    'last_name' => $validated_data['last_name'],
                    'phone' => $validated_data['phone']
                            ]);

            return response()->json([
                                        "status" => "success",
                                        null
                                    ], 200);
        }

        return response()->json(["message" => "Aucun compte trouvé !"], 404);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if(!is_null($user))
        {
            $user->status = false;
            $user->save();
            return response()->json(null, 204);
        }
        return response()->json(["message" => "Un problème est survenu lors de l'enregistrement"], 404);

    }
}
