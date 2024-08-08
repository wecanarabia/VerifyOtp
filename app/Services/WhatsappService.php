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
                    ->create(
                        "whatsapp:" . $data['phone'], // to
                        [
                            "contentSid" => env("TWILIO_TEMPLATE_SID"),
                            "from" => "whatsapp:+14148000019",
                            "contentVariables" => json_encode([
                                "1" => $data['otp'],
                                "2" => $data['name'],
                            ]),
                            "messagingServiceSid" => env("TWILIO_SERVICE_SID"),
                        ]

                    );
                return $message->body;
            }
        } catch (\Exception $e) {
            return 'Eror: ' . $e->getMessage();
        }
    }
}
