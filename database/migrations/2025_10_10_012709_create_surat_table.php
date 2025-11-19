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
        Schema::create('surat', function (Blueprint $table) {
            $table->uuid('id')->primary;
            $table->string('nim', 9);
            $table->string('jenis', 10);
            $table->string('dosen');
            $table->string('mata_kuliah', 255)->nullable();
            $table->string('judul', 200)->nullable();
            $table->string('kepada', 100)->nullable();
            $table->string('mitra', 100);
            $table->string('alamat');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->date('start');
            $table->date('end')->nullable();
            $table->string('kebutuhan', 10);
            $table->string('keterangan')->nullable();
            $table->integer('status', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
