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
            "app_id" => $this->app_id,
            "app_name" => $this->app_name,
            "token" => $this->token,
            "type" => $this->type,
            "number_of_messages" => $this->number_of_messages,
            "number_of_messages_sent" => $this->number_of_messages_sent,
            "number_of_digits" => $this->number_of_digits,
            "number_of_minutes" => $this->number_of_minutes,
            "unformal_whatsapp_token" => $this->unformal_whatsapp_token,
            "unformal_whatsapp_instance_id" => $this->unformal_whatsapp_instance_id,
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
        ];
    }
}
