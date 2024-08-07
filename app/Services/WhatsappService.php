<?php

namespace App\Services;

use Twilio\Rest\Client;

class WhatsappService
{
    private $token;
    private $sid;
    public function __construct()
    {
        $this->token = env("TWILIO_ACCOUNT_TOKEN");
        $this->sid = env("TWILIO_ACCOUNT_SID");
    }

    public function send($data)
    {
        try {
            if ($data['phone'] != null) {
                    $twilio = new Client($this->sid, $this->token);

                    $message = $twilio->messages
                    ->create("whatsapp:".$data['phone'], // to
                        array(
                        "from" => "whatsapp:+14148000019",
                        "body" => "Your ".$data['name']." code is ".$data['otp']
                        )
                    );
                    return $message->sid;

            }
        } catch (\Exception $e) {
            return 'Eror: ' . $e->getMessage();
        }
    }
}
