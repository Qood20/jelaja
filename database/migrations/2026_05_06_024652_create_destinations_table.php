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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operator_id')->constrained('users')->cascadeOnDelete();
            $table->string('name');
            $table->unsignedBigInteger('price');
            $table->string('opening_hours');
            $table->text('description');
            $table->string('location_maps_url');
            $table->string('contact_phone');
            $table->unsignedInteger('daily_quota')->default(100);
            $table->unsignedInteger('most_booked')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
