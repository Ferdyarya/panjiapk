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
        Schema::create('izinkunjungans', function (Blueprint $table) {
            $table->id();
            $table->string('kodesurat')->nullable();
            $table->string('tanggal');
            $table->string('tujuan_surat');
            $table->string('id_masterpegawai');
            $table->string('id_mastercabang');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izinkunjungans');
    }
};
