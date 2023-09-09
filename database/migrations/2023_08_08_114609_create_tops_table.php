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
        Schema::create('tops', function (Blueprint $table) {
            $table->id();
            $table->string("user_id");
            $table->string("upi");
            $table->string("amount");
            $table->string("file")->nullable();
            $table->string("token_key")->nullable();
            $table->string("channel")->nullable();
            $table->string("bank")->nullable();
            $table->text("comment")->nullable();
            $table->string("date")->nullable();
            $table->string("year")->nullable();
            $table->string("status")->default(0);
            $table->string("confirm_user")->default(0);
            $table->string("syn_flag")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tops');
    }
};
