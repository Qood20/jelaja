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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('gross_amount');
            $table->enum('status', ['pending', 'paid', 'expired'])->default('pending');
            $table->string('midtrans_token')->nullable();
            $table->string('midtrans_redirect_url')->nullable();
            $table->date('visit_date');
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamp('paid_at')->nullable();
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
