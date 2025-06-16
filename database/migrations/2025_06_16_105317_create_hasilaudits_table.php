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
        Schema::create('hasilaudits', function (Blueprint $table) {
            $table->id();
            $table->string('nmrsurat')->nullable();
            $table->string('id_mastercabang');
            $table->string('temuan');
            $table->string('tanggal');
            $table->string('nilai');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasilaudits');
    }
};
