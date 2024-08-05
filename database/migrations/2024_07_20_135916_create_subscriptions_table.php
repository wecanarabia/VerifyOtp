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
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('app_id')->nullable();
            $table->string('app_name')->nullable();
            $table->string('token')->nullable();
            $table->enum('type',['email','whatsapp','unformal_whatsapp']);
            $table->integer('number_of_messages')->default(0);
            $table->integer('number_of_messages_sent')->default(0);
            $table->integer('number_of_digits')->default(6);
            $table->integer('number_of_minutes')->default(5);
            $table->text('unformal_whatsapp_token')->nullable();
            $table->text('unformal_whatsapp_instance_id')->nullable();
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
