<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('riset4q2s', function (Blueprint $table) {
            $table->id();

            // Blok 1 - Wilayah Tugas
            $table->string('provinsi')->default('Sumatra Selatan');
            $table->string('kabupaten_kota');
            $table->string('kecamatan');
            $table->string('klasifikasi_wilayah');
            $table->string('nomor_blok_sensus');
            $table->string('kode_sls');
            $table->string('nama_sls');

            // Blok 2 - Identitas PCL
            $table->string('pcl_nama');
            $table->string('pcl_nim');
            $table->enum('pcl_jenis_kelamin', ['L', 'P']);

            // Blok 3 - Identitas Kortim
            $table->string('kortim_nama');
            $table->string('kortim_nim');
            $table->enum('kortim_jenis_kelamin', ['L', 'P']);

            // Blok 4 - Penjaminan Kualitas Pencacahan
            // Kelengkapan Dokumen
            $table->boolean('kd_peta')->default(false);
            $table->boolean('kd_daftar_sls')->default(false);
            $table->boolean('kd_daftar_sampel_sls')->default(false);
            $table->boolean('kd_bukped_listing')->default(false);
            $table->boolean('kd_surat_tugas')->default(false);
            $table->boolean('kd_surat_izin')->default(false);
            $table->boolean('kelengkapan_instrumen')->default(false);

            // Prosedur Wawancara
            $table->boolean('salam_pembuka')->default(false);
            $table->boolean('kesediaan_responden')->default(false);
            $table->boolean('perkenalan')->default(false);
            $table->boolean('tujuan_wawancara')->default(false);
            $table->boolean('surat_tugas')->default(false);
            $table->boolean('jaminan_kerahasiaan')->default(false);

            // Teknik Wawancara
            $table->boolean('kondisi_lingkungan')->default(false);
            $table->boolean('probing')->default(false);
            $table->boolean('konfirmasi_ulang')->default(false);
            $table->boolean('pemahaman_konsep_dan_definisi')->default(false);
            $table->boolean('leading')->default(false);
            $table->boolean('pertanyaan_interogatif')->default(false);
            $table->boolean('pengulangan_pertanyaan')->default(false);
            $table->string('metode_bertanya')->nullable();
            $table->boolean('pengisian_kuesioner')->default(false);
            $table->boolean('kewajaran')->default(false);
            $table->boolean('pemberitahuan_revisit')->default(false);
            $table->boolean('penutup_wawancara')->default(false);
            $table->integer('waktu')->default(0);


            // Tambahkan kolom timestamps
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riset4q2s');
    }
};
