<?php

namespace App\Services;

class WhatsappService
{
    private $token;
    private $headers;
    public function __construct()
    {
        $this->token = env("WHATSAPP_TOKEN");
        $this->headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'cache-control' => 'no-cache',
            'Authorization' => $this->token
        ];
    }

    public function send($data)
    {
        try {
            if ($data['phone'] != null) {



                $payload = [
                    "messaging_product" => "whatsapp",
                    "recipient_type" => "individual",
                    "to" => $data['phone'],
                    "type" => "template",
                    "template" => [
                        "name"=> $data['name'],
                        "language"=> ["code"=>"en_US"],
                        "body" => $data['otp'] . " is your OTP for " . $data['name'] . " verification.",
                    ]
                ];
                $client = new \GuzzleHttp\Client();
                $version = "";
                $phoneId = "";
                $url = "https://graph.facebook.com/$version/$phoneId/messages";
                $response = $client->request('POST', $url, [
                    'headers' => $this->headers,
                    'json' => $payload,
                ]);
                return $response->getBody();
            }
        } catch (\Exception $e) {
            return 'Eror: ' . $e->getMessage();
        }
    }
}
