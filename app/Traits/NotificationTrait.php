<?php
namespace App\Traits;

use DateTime;
use DateTimeZone;
use Carbon\Carbon;

trait NotificationTrait
{

    public function send($content, $title,$token/*,$type = null,$id = null,$image = null, $sound = null , $channel=null, $new = []*/)
    {
        // $icon = "https://dash.eascore.io/img/notify/sportk.png";
        // if (!$image) {
        //     $image = $icon;
        // }
        // if (!$sound) {
        //     $sound = "all_other_notification";
        // }
        // if (!$channel) {
        //     $channel = "channel_id_5";
        // }
        $msg = array
            (
            'body' => $content,
            'title' => $title,
            // 'image' => $image,
            // 'icon' => $icon,
            // 'sound'=>$sound,
            // "android_channel_id"=> $channel

        );

        // $data = [
        //         'id' => $id,
        //         'type' => $type,
        //         // 'channel_id'=>$channel,
        //     ];
            // if (count($new) > 0) {
            //     $data = array_merge($data, $new);
            // }
        if(is_array($token)) {
            $fields = [
                'registration_ids' => $token,
                'notification' => $msg,
                // 'data' => $data,
            ];
        } else {
            $fields = [
                'to' => $token,
                'notification' => $msg,
                'data' => $data,
            ];
        }
        $headers = array
            (
            'Authorization: key=' . env('FIREBASE_API_KEY'),
            'Content-Type: application/json',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    }
    public function sendUrl($content, $title,$token,$type = null,$url = null, $image=null)
    {
        $icon = "https://dash.eascore.io/img/notify/sportk.png";
        if (!$image) {
            $image = $icon;
        }
        $msg = array
            (
            'body' => $content,
            'title' => $title,
            'image' => $image,
            'icon' => $icon,
            'sound'=>"all_other_notification",
            "android_channel_id"=> "channel_id_5"
        );
        $data = [
                'url' => $url,
                'type' => $type,
                'channel_id' => 'channel_id_5', /*Default sound*/
            ];
            $fields = [
                'registration_ids' => $token,
                'notification' => $msg,
                'data' => $data,
            ];

        $headers = array
            (
            'Authorization: key=' . env('FIREBASE_API_KEY'),
            'Content-Type: application/json',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    }

    public function sendMatchId($content, $title,$token,$matchId)
    {
        $msg = array
            (
            'body' => $content,
            'title' => $title,
            'match_id' => $matchId,
            'sound' => 'mySound', /*Default sound*/
        );

            $fields = [
                'registration_ids' => $token,
                'notification' => $msg,
            ];

        $headers = array
            (
            'Authorization: key=' . env('FIREBASE_API_KEY'),
            'Content-Type: application/json',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    }
    public function sendBlogId($content, $title,$token,$blogId)
    {
        $msg = array
            (
            'body' => $content,
            'title' => $title,
            'blog_id' => $blogId,
            'sound' => 'mySound', /*Default sound*/
        );

            $fields = [
                'registration_ids' => $token,
                'notification' => $msg,
            ];

        $headers = array
            (
            'Authorization: key=' . env('FIREBASE_API_KEY'),
            'Content-Type: application/json',
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    }

    public function adNotificationSend($id, $status, $title, $content, $token)
    {
        $msg['title'] = $title;
        $msg['body'] = $content;
        $data = [
            'id' => $id,
            'advertisement' => $status,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        ];

        $fields = array
            (
            'to' => $token,
            'notification' => $msg,
            'data' => $data,
        );

        $headers = array
            (
            'Authorization: key=' . env('FIREBASE_API_KEY'),
            'Content-Type: application/json',
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        // dd(env('FIREBASE_API_KEY'));
        curl_close($ch);

        return true;
    }

    public function addNewNotificationSend($content, $token)
    {
        $msg['title'] = 'User Notification';
        $msg['body'] = $content;
        $data = [
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
        ];

        $fields = array
            (
            'to' => $token,
            'notification' => $msg,
            'data' => $data,
        );

        $headers = array
            (
            'Authorization: key=' . env('FIREBASE_API_KEY'),
            'Content-Type: application/json',
        );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //dd($result);
        curl_close($ch);

        return true;
    }
}
