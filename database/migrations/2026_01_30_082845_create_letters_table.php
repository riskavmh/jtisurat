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
        Schema::create('letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ref_no')->nullable();
            $table->uuid('type_id');
            $table->string('lecturer_id')->nullable();
            $table->string('course')->nullable();
            $table->string('research_title')->nullable();
            $table->string('to')->nullable();
            $table->string('company');
            $table->string('address');
            $table->string('subdistrict');
            $table->string('regency');
            $table->string('province');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('necessity', ['eksternal', 'internal']);
            $table->string('excuses')->nullable();
            $table->enum('status', ['diproses', 'dicetak', 'selesai', 'ditolak'])->default('diproses');
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('letter_type')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
