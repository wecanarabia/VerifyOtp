<?php

namespace App\Strategies;

use App\Interfaces\SmsInterface;
use App\Strategies\WhatsappStrategy;
use App\Strategies\UnformalWhatsappStrategy;

class DoubleWhatsappStrategy implements SmsInterface
{
    public function send($data)
    {
        $unformal = new UnformalWhatsappStrategy();
        $send = $unformal->send($data);
        $times = 0;
        while ((isset($send['status'])&&$send['status'] != "success")&& $times < 3) {
            $send = $unformal->send($data);
            $times++;
        }
        if ($times == 3) {
            $formalSend = new WhatsappStrategy();
            return $formalSend->send($data);
        }
        return true;
    }
}
