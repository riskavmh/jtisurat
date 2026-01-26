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
            $table->uuid('id')->primary;
            $table->integer('ref_no')->nullable();
            $table->string('nim', 9);
            $table->string('type', 10);
            $table->string('lecturer');
            $table->string('course', 255)->nullable();
            $table->string('research_title', 200)->nullable();
            $table->string('to', 100)->nullable();
            $table->string('company', 100);
            $table->string('address');
            $table->string('subdistrict');
            $table->string('regency');
            $table->string('province');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('necessity', 10);
            $table->string('note')->nullable();
            $table->integer('status', 1);
            $table->timestamps();
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
