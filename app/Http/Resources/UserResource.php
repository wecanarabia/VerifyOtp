<?php

namespace App\Http\Resources;

use App\Models\Unit;
use App\Models\Video;
use App\Models\Section;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone,
            'status' => $this->status,
            'wecan_id' => $this->wecan_id,
        ];
    }
}
