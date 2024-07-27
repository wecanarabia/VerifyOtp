<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "user_id" => $this->user_id,
            "subscription_id" => $this->subscription_id,
            "token" => $this->token,
            "type" => $this->type,
            "number_of_emails" => $this->number_of_emails,
            "number_of_whatsapp_msgs" => $this->number_of_whatsapp_msgs,
            "number_of_digits" => $this->number_of_digits,
            "number_of_minutes" => $this->number_of_minutes,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
        ];
    }
}
