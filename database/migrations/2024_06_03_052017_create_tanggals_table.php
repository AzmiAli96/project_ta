<?php

use App\Models\tanggal;
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
        Schema::create('tanggals', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('ruangan_id');
            $table->foreignId('sesi_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggals');
    }
};
