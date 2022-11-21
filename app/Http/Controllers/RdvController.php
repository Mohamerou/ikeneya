<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\RdvRequest;
use Illuminate\Support\Facades\Log;
use App\Models\Rdv;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use Carbon\Carbon;

class RdvController extends Controller
{
    //

    public function handleRdvRequest(Request $request)
    {
        // dd($request->all());



        $validatedData =    request()->validate([
            'doctor_id'             => 'required|string',
            'patient_id'            => 'required|string',
            'rdv_request_subject'   => 'required|string',
            'rdv_request_content'   => 'required|string',
            'rdv_time'              => 'required|string',
            'rdv_request_date'      => 'required|string',
        ]);



        $patient = User::find($validatedData['patient_id']);

        // print_r($patient);
        // Log::info("patient:");
        // Log::info($patient);
        // Log::info($request->all());



        $rdv = new Rdv;

        if(!empty($patient))
        {
            $rdv->patient_id            = $validatedData['patient_id'];
            $rdv->doctor_id             = $validatedData['doctor_id'];
            $rdv->patient_phone         = $patient->phone;
            $rdv->patient_name          = $patient->first_name." ".$patient->last_name;
            $rdv->patient_profil_pic    = $patient->patient->profil_pic;
            $rdv->rdv_request_subject   = $validatedData['rdv_request_subject'];
            $rdv->rdv_request_content   = $validatedData['rdv_request_content'];
            $rdv->rdv_request_date      = Carbon::parse($validatedData['rdv_request_date']);
            $rdv->rdv_time              = Carbon::parse($validatedData['rdv_time']);
            $rdv->rdv_status            = 'initiated';
            $rdv->save();
        }
        else {
            return response()->json([
                "message" => "patient found.",
                "status" => "error"
            ], 404);
        }

        // $rdv->rdv_request_date =    $rdv->rdv_request_date->format('d-m-Y');
        // $rdv->rdv_time =    $rdv->rdv_time->format('H:i');
        // $rdv->save();

        if(!empty($rdv))
        {
            $doctor  = User::find($validatedData['doctor_id']);

            $doctor->notify(new RdvRequest($rdv));

            // Log::info("doctor:");
            // Log::info($doctor);
            return response()->json([
                "message" => "Rendez-vous envoyé avec succès",
                "status" => "success"
            ], 200);
        }

        return response()->json([
            "error" => "Une erreure est survenue, veuillez réessayer.",
            "status" => "error"
        ], 404);

    }


}
