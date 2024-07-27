<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('subscription_id')->nullable();
            $table->string('token')->nullable();
            $table->enum('type',['email','whatsapp','both']);
            $table->integer('number_of_emails')->default(0);
            $table->integer('number_of_whatsapp_msgs')->default(0);
            $table->integer('number_of_digits')->default(6);
            $table->integer('number_of_minutes')->default(5);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
