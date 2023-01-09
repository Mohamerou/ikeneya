<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\RdvRequest;
use App\Notifications\RdvResponseNotification;
use Illuminate\Support\Facades\Log;
use App\Models\Rdv;
use App\Models\RdvResponse as ModelsRdvResponse;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;

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
        $doctor  = User::find($validatedData['doctor_id']);

        // print_r($patient);
        Log::info("patient:");
        Log::info($patient);
        Log::info($doctor);
        // Log::info($request->all());



        $rdv = new Rdv;

        if(!empty($patient))
        {
            $rdv->patient_id            = $validatedData['patient_id'];
            $rdv->doctor_id             = $validatedData['doctor_id'];
            $rdv->patient_phone         = $patient->phone;
            $rdv->doctor_name           = $doctor->first_name." ".$doctor->last_name;
            $rdv->patient_name          = $patient->first_name." ".$patient->last_name;
            $rdv->patient_profil_pic    = $patient->profil_pic;
            $rdv->rdv_request_subject   = $validatedData['rdv_request_subject'];
            $rdv->rdv_request_content   = $validatedData['rdv_request_content'];
            $rdv->rdv_request_date      = Carbon::parse($validatedData['rdv_request_date']);
            $rdv->rdv_time              = Carbon::parse($validatedData['rdv_time']);
            $rdv->rdv_status            = 'initiated';
            $rdv->save();
        }
        else {
            return response()->json([
                "message" => "patient account not found.",
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


    public function handleRdvResponse(Request $request)
    {

        // Patient reply / Validated the rdv as per checked value
        Log::info($request->all());

        if(!is_null($request->has('notification_id')) && !is_null($request->has('checked')) && isset($request->checked))
        {

            $validatedData =    request()->validate([
                'notification_id'   => 'required|string',
                'checked'         => 'required|string',
            ]);

            foreach(auth()->user()->unReadNotifications as $notification)
            {

                if($notification->id === $validatedData['notification_id'])
                {
                    $notification->markAsRead();
                    // dd("done!");
                    return redirect()->route('rdvs');
                }
            }

        }




        // Doctor reply / Doctor validation : indicated by the value within the $validated variable
        if(!is_null($request->has('notification_id')) && !is_null($request->has('validated')) && isset($request->validated))
        {

            Log::info("Reached rdv response end point !");
            // dd("Hi");
            $validatedData =    request()->validate([
                'notification_id'       => 'required|string',
                'patient_id'            => 'required|string',
                'doctor_id'             => 'required|string',
                'rdv_response_subject'  => 'required|string',
                'rdv_response_content'  => 'required|string',
                'rdv_response_date'     => 'required|string',
                'rdv_time'              => 'required|string',
                'validated'             => 'required|string',
            ]);

            
            Log::info("Validated data !");

            // dd($request->all());
            $doctor = User::find($validatedData['doctor_id']);

            if(!empty($doctor)){
                foreach($doctor->unReadNotifications as $notification)
                {
    
            // Log::info($request->all());
                    if($notification->id === $validatedData['notification_id'])
                    {
                        // dd($notification);
                        $notification->markAsRead();
                        // $notification->data['rdv_status'] = "validated";
    
                        // $dbNotification = ModelsRdvResponse::where();
    
                        $patient = User::find($notification->data['patient_id']);
                        // $doctor  = User::find($notification->data['doctor_id']);
    
    
    
                        $rdv_status = 
                        $rdv_response = new ModelsRdvResponse;
    
    
                        $rdv_response->patient_id            = $notification->data['patient_id'];
                        $rdv_response->doctor_id             = $notification->data['doctor_id'];
                        $rdv_response->doctor_phone          = $doctor->phone;
                        $rdv_response->doctor_name           = $doctor->first_name." ".$doctor->last_name;
                        $rdv_response->patient_name          = $patient->first_name." ".$patient->last_name;
                        $rdv_response->doctor_profil_pic     = $doctor->profil_pic;
                        $rdv_response->rdv_response_subject   = $notification->data['rdv_request_subject'];
                        $rdv_response->rdv_response_content   = $notification->data['rdv_request_content'];
                        $rdv_response->rdv_response_date      = Carbon::parse($notification->data['rdv_request_date']);
                        $rdv_response->rdv_time               = Carbon::parse($notification->data['rdv_time']);
                        $rdv_response->rdv_response_status    = $validatedData['validated'];
    
                        $rdv_response->save();
    
    
                        $patient->notify(new RdvResponseNotification($rdv_response));
    
                        Log::info("Notification validation response sent !!!");
                        Log::info("Doc's reply");
                        Log::info($rdv_response);
    
                        return response()->json([
                            'message' => "Rendez-vous validé avec succès!",
                            'status'  => 'success'
                        ], 200);
                    } else {
    
                        return response()->json([
                            'error' => "Aucune correspondance !",
                            'status'  => 'error'
                        ], 403);
                    }
                }
    
                return response()->json([
                    'error' => "Compte inexistant!",
                    'status'  => 'error'
                ], 403);
            }
        }

    }




}
