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
        Schema::create('calegs', function (Blueprint $table) {
            $table->id();
            $table->string('foto');
            $table->string('nama');
            $table->string('ttl');
            $table->string('alamat');
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->string('pendidikan_terakhir');
            $table->unsignedBigInteger('partaiId');
            $table->timestamps();

            $table->foreign('partaiId')->references('id')->on('partais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calegs');
    }
};
