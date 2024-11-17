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
        Schema::create('suratpusats', function (Blueprint $table) {
            $table->id();
            $table->string('kodesurat')->nullable();
            $table->string('asalsurat');
            $table->string('tujuan_surat');
            $table->string('tentangsurat');
            $table->string('filesurat');
            $table->string('klasifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratpusats');
    }
};
