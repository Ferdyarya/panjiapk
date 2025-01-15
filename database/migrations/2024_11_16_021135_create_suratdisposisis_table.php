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
        Schema::create('suratdisposisis', function (Blueprint $table) {
            $table->id();
            $table->string('nmrsurat')->nullable();
            $table->string('tglterima');
            $table->string('sifat');
            $table->string('perihal');
            $table->string('diteruskan');
            $table->string('catatan');
            $table->string('disposisi');
            $table->string('id_mastercabang');
            $table->string('id_masterpegawai');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratdisposisis');
    }
};
