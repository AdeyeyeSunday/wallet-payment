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
        Schema::create('send_money', function (Blueprint $table) {
            $table->id();
            $table->string("fname")->nullable();
            $table->string("upi")->nullable();
            $table->string("amount")->nullable();
            $table->text("comment")->default(0);
            $table->string("status")->default(0);
            $table->string("confirm_user")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('send_money');
    }
};
