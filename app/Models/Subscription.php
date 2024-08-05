<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::creating(function($subscription) {
            $subscription->token = rand(100,1000) . "|" . Str::random(60);
            $subscription->app_id = rand(1000000000, 9999999999);
        });
    }
}
