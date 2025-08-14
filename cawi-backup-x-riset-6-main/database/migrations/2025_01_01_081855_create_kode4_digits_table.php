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
        Schema::create('kode4_digit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kode_3_digit_id');
            $table->string('kode_4_digit');
            $table->string('judul');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('kode_3_digit_id')
                ->references('id')
                ->on('kode3_digit')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode4_digits');
    }
};
