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
        Schema::create('penjumlahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nilai_id');
            $table->string('penilai');
            $table->String('n1')->nullable();
            $table->String('n2')->nullable();
            $table->String('n3')->nullable();
            $table->String('n4')->nullable();
            $table->String('n5')->nullable();
            $table->String('n6')->nullable();
            $table->String('n7')->nullable();
            $table->String('n8')->nullable();
            $table->String('n9')->nullable();
            $table->String('n10')->nullable();
            $table->String('total_nilai')->nullable();
            $table->String('rata-rata')->nullable();
            $table->String('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjumlahans');
    }
};
