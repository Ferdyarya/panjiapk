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
        Schema::create('izinusahas', function (Blueprint $table) {
            $table->id();
            $table->string('kodesurat')->nullable();
            $table->string('tujuan_surat');
            $table->string('atasnama');
            $table->string('tanggal');
            $table->string('keterangan');
            $table->string('kategoripertanian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izinusahas');
    }
};
