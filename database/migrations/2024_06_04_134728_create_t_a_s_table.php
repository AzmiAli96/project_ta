<?php

use App\Models\Mahasiswa;
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
        Schema::create('t_a_s', function (Blueprint $table) {
            $table->id();
            $table->char('nobp', 10)->unique();
            $table->foreign('nobp')->references('nobp')->on('mahasiswas');
            $table->string('judul');
            $table->string('dokumen');
            $table->foreignId('pembimbing1')->constrain('dosen_id');
            $table->foreignId('pembimbing2')->constrain('dosen_id');
            $table->string('ket')->nullable();
            $table->string('komentar')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_a_s');
    }
};
