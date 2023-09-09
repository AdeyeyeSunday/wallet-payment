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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string("fname");
            $table->string("upi");
            $table->string("invoice_file");
            $table->string("inovice_amt");
            $table->string("amt_paid");
            $table->string("balance")->nullable();
            $table->string("status")->nullable();
            $table->string("comment")->nullable();
            $table->string("confirm_payment_by")->nullable();
            $table->string("updated_payment_by")->nullable();
            $table->string("date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
