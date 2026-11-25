<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nrp')->nullable();
            $table->string('prodi')->nullable();
            $table->string('email')->nullable();
            $table->string('posisi');
            $table->text('deskripsi');
            $table->boolean('status')->default(true);
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_profiles');
    }
};
