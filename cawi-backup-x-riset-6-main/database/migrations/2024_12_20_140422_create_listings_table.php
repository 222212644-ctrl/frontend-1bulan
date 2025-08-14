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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('provinsi');
            $table->string('kab_kota');
            $table->string('kecamatan');
            $table->string('kel_des');
            $table->string('nomor_sls');
            $table->string('nama_sls');
            $table->string('no_sub_sls');
            $table->integer('no_bangunan_fisik');
            $table->integer('no_bangunan_sensus');
            $table->string('nama_KRT');
            $table->text('alamat_bangunan_sensus');
            $table->integer('jumlah_usaha');
            $table->tinyInteger('is_lebih_dari_1_bulan')->nullable();
            $table->tinyInteger('is_usaha')->nullable();
            $table->tinyInteger('is_jualan')->nullable();
            $table->tinyInteger('is_jasa')->nullable();
            $table->tinyInteger('is_rata_pendapatan_kotor')->nullable();
            $table->tinyInteger('is_rata_modal_usaha')->nullable();
            $table->tinyInteger('is_modal_sewa_tanah')->nullable();
            $table->tinyInteger('is_eligible')->nullable();
            $table->tinyInteger('is_ekonomi_lingkungan_1')->nullable();
            $table->tinyInteger('is_ekonomi_lingkungan_2')->nullable();
            $table->tinyInteger('is_ekonomi_lingkungan_3')->nullable();
            $table->tinyInteger('is_ekonomi_lingkungan_eligible')->nullable();
            $table->tinyInteger('is_ekonomi_digital_1')->nullable();
            $table->tinyInteger('is_ekonomi_digital_eligible')->nullable();
            $table->tinyInteger('is_ekonomi_kreatif_1')->nullable();
            $table->tinyInteger('is_ekonomi_kreatif_eligible')->nullable();
            $table->decimal('titik_Lokasi', 10, 7);
            $table->string('gambar_rumah');
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
