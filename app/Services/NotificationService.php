<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserNotifcation;

class NotificationService{

    static function send($notification_id, $id, $title, $message, $type) {
 
        $accesstoken = get_fcm_key();

        $url = 'https://fcm.googleapis.com/fcm/send';

            $post_data = '{
                "to" : "' . $notification_id . '",
                "data" : {
                  "body" : "",
                  "title" : "' . $title . '",
                  "type" : "' . $type . '",
                  "id" : "' . $id . '",
                  "message" : "' . $message . '",
                },
                "notification" : {
                     "body" : "' . $message . '",
                     "title" : "' . $title . '",
                      "type" : "' . $type . '",
                     "id" : "' . $id . '",
                     "message" : "' . $message . '",
                    "icon" : "new",
                    "sound" : "default"
                    },
     
              }';
            // print_r($post_data);die;
     
        $headr = array();
        $headr[] = 'Content-type: application/json';
        $headr[] = 'Authorization: key=' . $accesstoken;
        
        $response = curl_service($headr, $post_data, $url);
     
        if ($response === false) {
            // throw new Exception('Curl error: ' . curl_error($crl));
            //print_r('Curl error: ' . curl_error($crl));
            $result_noti = 0;
        } else {
     
            $result_noti = 1;
        }
     
        //curl_close($crl);
        //print_r($result_noti);die;
        return $result_noti;
    }

    static function sendAll($title, $body)
    {
        $firebaseToken = User::whereNotNull('token')->where('is_noti', 1)->pluck('token')->all();
        
        $SERVER_API_KEY = get_fcm_key();

        $url = 'https://fcm.googleapis.com/fcm/send';
  
        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $response = curl_service($headers, $dataString, $url);

        return $response;
    }

    static function sendAdmin($notification_ids)
    {        
        $SERVER_API_KEY = get_fcm_key();

        $url = 'https://fcm.googleapis.com/fcm/send';

        $title = 'Course ၀ယ်လိုက်ပြီ။';

        $body = 'Course ၀ယ်သူရှိပါတယ် သွားကြည့်ပေးပါ။';
  
        $data = [
            "registration_ids" => $notification_ids,
            "notification" => [
                "title" => $title,
                "body" => $body,
            ]
        ];
        $dataString = json_encode($data);
    
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $response = curl_service($headers, $dataString, $url);

        return $response;
    }

    static function save($user, $title, $message)
    {
        $notification = new UserNotifcation();
        $notification->user_id = $user->id;
        $notification->title = $title;
        $notification->body = $message;
        $notification->is_read = 0;
        $notification->datetime = date('Y-m-d H:i:s');
        $notification->save();
    }
}