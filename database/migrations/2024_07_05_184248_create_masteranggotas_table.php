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
        Schema::create('masteranggotas', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('no_telp');
            $table->string('kelas');
            $table->string('id_anggota');
            $table->string('jeniskelamin');
            $table->string('tgl_lahir');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masteranggotas');
    }
};
