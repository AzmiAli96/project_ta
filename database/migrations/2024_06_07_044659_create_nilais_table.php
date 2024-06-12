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
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sidang_id')->unique();
            $table->float('nilai_ketua')->nullable();
            $table->float('nilai_sekre')->nullable();
            $table->float('nilai_ang1')->nullable();
            $table->float('nilai_ang2')->nullable();
            $table->float('nilai_akhir')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
