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
        Schema::create('kode3_digit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_2_digit_id');
            $table->string('kode_3_digit');
            $table->string('judul');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('kode_2_digit_id')
                ->references('id')
                ->on('kode2_digit')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode3_digits');
    }
};
