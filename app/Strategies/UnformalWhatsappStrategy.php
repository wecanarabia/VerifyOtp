<?php

namespace App\Strategies;

use App\Interfaces\SmsInterface;

class UnformalWhatsappStrategy implements SmsInterface
{
    private $token;
    private $headers;
    public function __construct()
    {
        $this->headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'cache-control' => 'no-cache',
        ];
    }

    public function send($data)
    {
        try {
            if ($data['contact'] != null) {




                $client = new \GuzzleHttp\Client();
                $url = "http://dash.nashme.net/api/send?number=" . $data['contact'] . "&type=text&message=" . $data['otp'] . " is your OTP for " . $data['name'] . " verification.&instance_id=" . $data['instance_id'] . "&access_token=" . $data['token'];
                $response = $client->request('POST', $url, [
                    'headers' => $this->headers,
                    'json' => "",
                ]);
                return $response->getBody();
            }
        } catch (\Exception $e) {
            return 'Eror: ' . $e->getMessage();
        }
    }
}
