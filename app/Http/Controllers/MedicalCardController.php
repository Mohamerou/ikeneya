<?php

namespace App\Http\Controllers;

use App\Models\MedicalCard;
use Illuminate\Http\Request;

class MedicalCardController extends Controller
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
            'medical_cards'  => MedicalCard::all()
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

        $new_medical_card = MedicalCard::create([
            'name' => $validated_data["name"],
            'address' => $validated_data["address"],
            'contact' => $validated_data["contact"],
            'type' => $validated_data["type"]
        ]);

        if(!is_null($new_medical_card)) {
            return response([
                'status' => 'success',
                "new_medical_card" => $new_medical_card
            ], 200);
        }

        return response()->json(["message" => "Un problème est survenu lors de l'enregistrement"], 404);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalCard  $medicalCard
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalCard $medicalCard)
    {
        $request = new Request();
        $request->request->add(['id' => $medicalCard->id]); //add request
        $validated_data = $request->validate([
            'id' => "required|numeric"
        ]);

        $medical_card = MedicalCard::find($validated_data['id']);
        if(!is_null($medical_card))
        {
            return response()->json([
                'status' => 'success',
                "medical_card" => $medical_card
            ], 200);
        }

        return response()->json(null, 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalCard  $medicalCard
     * @return \Illuminate\Http\Response
     */
    public function edit(MedicalCard $medicalCard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalCard  $medicalCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalCard $medicalCard)
    {
        $request = new Request();
        $request->request->add(['id' => $medicalCard->id]); //add request

        $validated_data = $request->validate([
            'id' => "required|numeric",
            'name' => "required|string",
            'address' => "required|string",
            'type' => "required|string",
        ]);


        $medical_card = MedicalCard::find($validated_data['id']);

        if(!is_null($medical_card)) {

            $medical_card->update([
                    'name'      => $validated_data['name'],
                    'address'   => $validated_data['address'],
                    'type'      => $validated_data['type']
                ]);

            return response()->json([
                'status' => 'success',
                "medical_card" => $medical_card
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalCard  $medicalCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalCard $medicalCard)
    {
        $request = new Request();
        $request->request->add(['id' => $medicalCard->id]); //add request

        $validated_data = $request->validate([
            'id' => "required|numeric"
        ]);

        $medical_card = MedicalCard::find($validated_data['id']);
        if(!is_null($medical_card))
        {
            $medical_card->status = false;
            $medical_card->save();

            return response()->json([
                'status' => 'success',
                "medical_card" => $medical_card
                ], 204);
        }
        return response()->json(["message" => "Un problème est survenu"], 404);
    }
}
