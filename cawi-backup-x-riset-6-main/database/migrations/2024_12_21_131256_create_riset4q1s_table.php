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
        Schema::create('riset4q1s', function (Blueprint $table) {
            $table->id();

            // Blok 1 - Wilayah Tugas Listing
            $table->string('provinsi')->default('16');
            $table->string('kabupaten_kota');
            $table->string('kecamatan');
            $table->string('klasifikasi_wilayah');
            $table->string('nomor_blok_sensus');
            $table->string('kode_sls', 4);
            $table->string('nama_sls', 100);

            // Blok 2 - Identitas PCL
            $table->string('pcl_nama', 50);
            $table->string('pcl_nim', 9);
            $table->enum('pcl_jenis_kelamin', ['L', 'P']);

            // Blok 3 - Identitas Kortim
            $table->string('kortim_nama', 50);
            $table->string('kortim_nim', 9);
            $table->string('kortim_jenis_kelamin');

            // Blok 4 - Penjaminan Kualitas Listing
            $table->boolean('kd_peta')->default(false);
            $table->boolean('kd_daftar_sls')->default(false);
            $table->boolean('kd_kuesioner_listing')->default(false);
            $table->boolean('kd_bukped_listing')->default(false);
            $table->boolean('kd_surat_tugas')->default(false);
            $table->boolean('kd_surat_izin')->default(false);
            $table->boolean('kelengkapan_instrumen')->default(false);
            $table->boolean('koordinasi_ketua_sls')->default(false);
            $table->boolean('proses_penelusuran_wilayah')->default(false);
            $table->boolean('cakupan_listing')->default(false);
            $table->boolean('geotagging')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riset4q1s');
    }
};
