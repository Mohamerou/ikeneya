<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rdv;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\RdvRequest;

class NotificationController extends Controller
{
    //
    public function CheckNotification(Request $request)
    {

        // Log::info("hi notif");

        $data = $request->validate([
            "user_id" => 'required|numeric',
        ]);

        $user_notifications = [];
        $user = User::find($data['user_id']);


        // Log::info($user);

            $notifications = $user->unReadNotifications;


            if(!is_null($notifications))
            {
                Log::info("user notifications");
                Log::info($notifications);

                if($user->hasRole('user'))
                {
                    foreach ($notifications as $notification) {
                        // Log::info("patient");
                        $user_notifications[] = [
                            'title' => $notification->data['rdv_response_subject'],
                            'body' => $notification->data['rdv_response_content'],
                        ];

                        Log::info($user_notifications);
                    }
                }

                if ($user->hasRole('doctor'))
                {
                    foreach ($notifications as $notification) {
                        // Log::info("doc");

                        // print_r($notification);

                        $user_notifications[] = [
                            'title' => $notification->data['rdv_request_subject'],
                            'body' => $notification->data['rdv_request_content'],
                        ];
                    }
                }

                return response()->json([
                    'notifications' => $user_notifications,
                ], 200);
            } else {

                return response()->json([
                    'notifications' => "none",
                ], 201);
            }

    }


    public function getUserNotifications(Request $request)
    {

        // Log::info("All notif");

        $data = $request->validate([
            "user_id" => 'required|numeric',
        ]);

        $user_notifications = [];
        $user = User::find($data['user_id']);


        // Log::info($user);

            $notifications = $user->notifications;


            if(!is_null($notifications))
            {
                // Log::info($notifications);

                if($user->hasRole('user'))
                {
                    foreach ($notifications as $notification) {
                        // Log::info("patient");

                        $doctor = User::find($notification->data['doctor_id']);
                        $patient = User::find($notification->data['patient_id']);

                        if ($notification->read_at == null) {
                            $read_at = "";
                        } else {
                            $read_at = $notification->read_at;
                        }






                        $user_notifications[] = [
                            'id' => $notification->id,
                            'doctor_id' => $notification->data['doctor_id'],
                            'patient_id' => $notification->data['patient_id'],
                            "doctor_name"           => $doctor->first_name." ".$doctor->last_name,
                            "patient_name"          => $patient->first_name." ".$patient->last_name,
                            'title' => $notification->data['rdv_response_subject'],
                            'body' => $notification->data['rdv_response_content'],
                            'type' => 'response',
                            'date' => date('d-m-Y', strtotime($notification->data['rdv_response_date'])),
                            'rdv_time' => date('H:i:s', strtotime($notification->data['rdv_time'])),
                            'profil_pic' => $user->profil_pic,
                            'read_at' => $read_at,
                        ];

                    }
                }

                if ($user->hasRole('doctor'))
                {
                    foreach ($notifications as $notification) {
                        // Log::info("doc");

                        // print_r($notification);

                        if ($notification->read_at == null) {
                            $read_at = "";
                        } else {
                            $read_at = $notification->read_at;
                        }

                        $user_notifications[] = [
                            'id' => $notification->id,
                            'doctor_id' => $notification->data['doctor_id'],
                            'doctor_name' => $notification->data['doctor_name'],
                            'patient_name' => $notification->data['patient_name'],
                            'patient_id' => $notification->data['patient_id'],
                            'title' => $notification->data['rdv_request_subject'],
                            'body' => $notification->data['rdv_request_content'],
                            'type' => "request",
                            'date' => date('d-m-Y', strtotime($notification->data['rdv_request_date'])),
                            'rdv_time' => date('H:i:s', strtotime($notification->data['rdv_time'])),
                            'rdv_status' => $notification->data['rdv_status'],
                            'profil_pic' => $user->profil_pic,
                            'read_at' => $read_at,
                        ];

                        // Log::info(print("Log::info(user_notifications)"));
                        Log::info($user_notifications);
                    }
                }


                return response()->json([
                    // header('Content-Type: application/json'),
                    'notifications' => $user_notifications,
                ], 200);
            } else {

                return response()->json([
                    // header('Content-Type: application/json'),
                    'notifications' => "none",
                ], 201);
            }

    }


    public function markNotifAsread(Request $request)
    {

        Log::info("Mark as read!");

        $data = $request->validate([
            "user_id" => 'required|numeric',
            "notification_id" => 'required|string',
        ]);
        // Log::info($data);

        $user_notifications = [];
        $user = User::find($data['user_id']);


        // Log::info($user);

            $notifications = $user->unReadNotifications;


            if(!is_null($notifications))
            {
                // Log::info($notifications);
                    foreach ($notifications as $notification) {

                        if ($notification->id == $data['notification_id']){
                            // Log::info("marked as read!");

                            $notification->markAsRead();
                        }
                    }
            }

            return response()->json([
                // header('Content-Type: application/json'),
                'status' => 'success',
            ], 200);
        }
}
