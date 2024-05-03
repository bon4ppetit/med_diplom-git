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
        Schema::create('records_to_doctor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->references('id')->on('users');
            $table->foreignId('doctor_id')->references('id')->on('doctors');
            $table->string('record_datetime', 50);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records_to_doctor');
    }
};
