<?php

namespace App\Services;

class EmailService
{
    private $token;
    private $headers;
    public function __construct()
    {
        $this->token = env("ZOHO_MAIL_TOKEN");
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
            if ($data['email'] != null) {



                $payload = [
                    "from" => ["address" => "noreply@doverifyit.com"],
                    "to" => [["email_address" => ["address" => $data['email'], 'name' => $data['name']??'']]],
                    "subject" => "OTP Verification",
                    "htmlbody" => $data['otp'] . " is your OTP for " . $data['name'] . " verification.",
                ];
                $client = new \GuzzleHttp\Client();
                $response = $client->request('POST', "https://api.zeptomail.com/v1.1/email", [
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
