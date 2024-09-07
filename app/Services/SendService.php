<?php

namespace App\Services;

use App\Interfaces\SmsInterface;

class SendService
{
    private $smsInterface;

    public function __construct(SmsInterface $smsInterface) {
        $this->smsInterface = $smsInterface;
    }

    public function sendSms($data)
    {
        return $this->smsInterface->send($data);
    }
}
