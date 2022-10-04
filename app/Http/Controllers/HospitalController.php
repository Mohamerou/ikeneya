<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return response()->json([
            'status'    => 'success',
            'hospitals'  => Hospital::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name' => "required|string",
            'address' => "required|string",
            'contact' => "required|string",
            'type' => "required|string"
        ]);

        $new_hospital = Hospital::create([
            'name' => $validated_data["name"],
            'address' => $validated_data["address"],
            'contact' => $validated_data["contact"],
            'type' => $validated_data["type"]
        ]);

        if(!is_null($new_hospital)) {
            return response([
                'status' => 'success',
                "new_hospital" => $new_hospital
            ], 200);
        }

        return response()->json(["message" => "Un problème est survenu lors de l'enregistrement"], 404);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $request = new Request();

        $request->merge(['id' => $id]);

        $validated_data = $request->validate([
            'id' => "required|numeric"
        ]);

        $hospital = Hospital::find($validated_data['id']);
        if(!is_null($hospital))
        {
            return response()->json([
                'status' => 'success',
                "hospital" => $hospital
            ], 200);
        }

        return response()->json(null, 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function edit(Hospital $hospital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request = new Request();
        $request->request->add(['id' => $id]); //add request

        $validated_data = $request->validate([
            'id' => "required|numeric",
            'name' => "required|string",
            'address' => "required|string",
            'type' => "required|string",
        ]);


        $hospital = Hospital::find($validated_data['id']);

        if(!is_null($hospital)) {

            $hospital->update([
                    'name'      => $validated_data['name'],
                    'address'   => $validated_data['address'],
                    'type'      => $validated_data['type']
                ]);

            return response()->json([
                'status' => 'success',
                "hospital" => $hospital
            ], 200);
        }

        return response()->json(["message" => "Aucun hopital trouvé !"], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hospital  $hospital
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = new Request();
        $request->request->add(['id' => $id]); //add request

        $validated_data = $request->validate([
            'id' => "required|numeric"
        ]);

        $hospital = Hospital::find($validated_data['id']);
        if(!is_null($hospital))
        {
            $hospital->status = false;
            $hospital->save();
            return response()->json([
                'status' => 'success',
                "hospital" => $hospital
                ], 204);
        }
        return response()->json(["message" => "Un problème est survenu"], 404);
    }
}
