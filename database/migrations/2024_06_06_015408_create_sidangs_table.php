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
        Schema::create('sidangs', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('validasi_id')->unique();
            $table->foreignId('ta_id')->unique();
            $table->date('tanggal');
            $table->foreignId('ruangan_id');
            $table->foreignId('sesi_id');
            $table->string('ketua_sidang')->constrain('dosen_id');
            $table->string('sekr_sidang')->constrain('dosen_id');
            $table->string('anggota1')->constrain('dosen_id');
            $table->string('anggota2')->constrain('dosen_id');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidangs');
    }
};
