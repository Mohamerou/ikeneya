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

    public function RdvRequest(Request $request)
    {
        $data   = $request->validate([
            'token'             => 'required|string',
            'patient_id'        => 'required|numeric',
            'doctor_id'         => 'required|numeric',
            'patient_fullname'  => 'required|string|max:255',
            'patient_phone'     => 'required|string|max:255',
            'rdv_subject'       => 'required|string|max:255',
            'rdv_content'       => 'required|string|max:255',
            'rdv_date'          => 'required|string|max:255',
            'patient_urlAvatar' => 'required|string|max:255',
        ]);


        $rdv = Rdv::create([
            'token'             => $data['token'],
            'patient_id'        => $data['patient_id'],
            'doctor_id'         => $data['doctor_id'],
            'patient_fullname'  => $data['patient_fullname'],
            'patient_phone'     => $data['patient_phone'],
            'rdv_subject'       => $data['rdv_subject'],
            'rdv_content'       => $data['rdv_content'],
            'rdv_date'          => $data['rdv_date'],
            'patient_urlAvatar' => $data['patient_urlAvatar'],
        ]);


            // $userNotification->markAsRead();


                // Notification to Doctor
                $user           = User::find($rdv->doctor_id);

                Notification::send($user, new RdvRequest($rdv));


                // $code = Nexmo::message()->send([
                //                             'to'   => '+223'.$usager->phone,
                //                             'from' => '+22389699245',
                //                             'text' => "ikV, La demande de vignette pour votre ".$engin->modele." est validée avec succès. Retrouver votre code QR sur le menu ikaVignetti.   ",
                //                             ]);
                // dd($vignette);

        $url = 'https://fcm.googleapis.com/fcm/send';
        $dataArr = array('click_action' => 'FLUTTER_NOTIFICATION_CLICK', 'id' => $request->id,'status'=>"done");
        $notification = array('title' =>$request->subject, 'body' => $request->content, 'image'=> $request->patient_urlAvatar, 'sound' => 'default', 'badge' => '1',);
        $arrayToSend = array('to' => $request->token, 'notification' => $notification, 'data' => $dataArr, 'priority'=>'high');
        $fields = json_encode ($arrayToSend);
        $headers = array (
            'Authorization: key=' . "BMu2RUSVMnV6E4Nr82i6JtkEC66Uwisz2L3cI1E59VOSarK0p3u0nQ2vwU20rHSgXeI5inaqOkJ1BKfaHW9Bdqw",
            'Content-Type: application/json'
        );

        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

        $result = curl_exec ( $ch );
        //var_dump($result);
        curl_close ( $ch );
        return $result;
    }

    public function CheckNotification(Request $request)
    {

        Log::info("hi notif");

        $data = $request->validate([
            "user_id" => 'required|numeric',
        ]);

        $user_notifications = [];
        $user = User::find($data['user_id']);


        Log::info($user);

            $notifications = $user->unReadNotifications;


            if(!is_null($notifications))
            {
                Log::info($notifications);

                if($user->hasRole('user'))
                {
                    foreach ($notifications as $notification) {
                        Log::info("patient");
                        $user_notifications[] = [
                            'title' => $notification->data['rdv_response_subject'],
                            'body' => $notification->data['rdv_response_content'],
                        ];
                    }
                }

                if ($user->hasRole('doctor'))
                {
                    foreach ($notifications as $notification) {
                        Log::info("doc");

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

        Log::info("All notif");

        $data = $request->validate([
            "user_id" => 'required|numeric',
        ]);

        $user_notifications = [];
        $user = User::find($data['user_id']);


        Log::info($user);

            $notifications = $user->notifications;


            if(!is_null($notifications))
            {
                Log::info($notifications);

                if($user->hasRole('user'))
                {
                    foreach ($notifications as $notification) {
                        Log::info("patient");



                        if ($notification->read_at == null) {
                            $read_at = "";
                        } else {
                            $read_at = $notification->read_at;
                        }

                        $user_notifications[] = [
                            'id' => $notification->id,
                            'doctor_id' => $notification->data['doctor_id'],
                            'patient_id' => $notification->data['patient_id'],
                            'title' => $notification->data['rdv_response_subject'],
                            'body' => $notification->data['rdv_response_content'],
                            'type' => 'response',
                            'date' => date('d-m-Y', strtotime($notification->data['rdv_response_date'])),
                            'rdv_time' => date('H:i:s', strtotime($notification->data['rdv_time'])),
                            'profil_pic' => $user->patient->profil_pic,
                            'read_at' => $read_at,
                        ];

                    }
                }

                if ($user->hasRole('doctor'))
                {
                    foreach ($notifications as $notification) {
                        Log::info("doc");

                        // print_r($notification);

                        if ($notification->read_at == null) {
                            $read_at = "";
                        } else {
                            $read_at = $notification->read_at;
                        }

                        $user_notifications[] = [
                            'id' => $notification->id,
                            'doctor_id' => $notification->data['doctor_id'],
                            'patient_id' => $notification->data['patient_id'],
                            'title' => $notification->data['rdv_request_subject'],
                            'body' => $notification->data['rdv_request_content'],
                            'type' => "request",
                            'date' => date('d-m-Y', strtotime($notification->data['rdv_request_date'])),
                            'rdv_time' => date('H:i:s', strtotime($notification->data['rdv_time'])),
                            'rdv_status' => $notification->data['rdv_status'],
                            'profil_pic' => $user->doctor->profil_pic,
                            'read_at' => $read_at,
                        ];
                    }
                }

                Log::info($user_notifications);

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
        Log::info($data);

        $user_notifications = [];
        $user = User::find($data['user_id']);


        Log::info($user);

            $notifications = $user->unReadNotifications;


            if(!is_null($notifications))
            {
                Log::info($notifications);
                    foreach ($notifications as $notification) {

                        if ($notification->id == $data['notification_id']){
                            Log::info("marked as read!");

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
