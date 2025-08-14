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
        Schema::create('kode2_digit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_sektor_id');
            $table->string('kode_2_digit');
            $table->string('judul');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('kode_sektor_id')
                ->references('id')
                ->on('sektor')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode2_digits');
    }
};
