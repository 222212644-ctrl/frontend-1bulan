<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riset_utamas', function (Blueprint $table) {
            $table->id();

            // Blok I: Keterangan Tempat
            // 100. Waktu Pencacahan
            $table->date('tanggal_pencacahan');
            $table->time('waktu_mulai_pencacahan');
            $table->time('waktu_selesai_pencacahan');

            // 101-107. Lokasi dan Identifikasi
            $table->string('provinsi', 2)->default('16'); // Default Sumatera Selatan
            $table->string('kabupaten_kota', 2);
            $table->string('kecamatan', 3);
            $table->string('kelurahan_desa', 3);
            $table->string('nomor_sls', 4); // Nomor SLS
            $table->string('nama_sls'); // Nama Satuan Lingkungan Setempat
            $table->string('nomor_urut_sampel_pencacahan', 3);

            // 108-110. Informasi Usaha
            $table->string('nama_lengkap_usaha');
            $table->text('alamat_lengkap_usaha');
            $table->string('rt', 3)->nullable();
            $table->string('rw', 3)->nullable();
            $table->string('kode_pos', 5)->nullable();
            $table->string('telepon_hp', 15)->nullable();
            $table->string('faksimile')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            // Blok II: Keterangan Petugas dan Pemberi Jawaban
            $table->string('nama_responden')->nullable();
            $table->string('telepon_hp_responden', 14)->nullable();

            $table->string('nama_pencacah')->nullable();
            $table->string('telepon_hp_pencacah', 14)->nullable();
            $table->string('nim_pencacah', 9)->nullable();

            $table->string('nama_koordinator')->nullable();
            $table->string('telepon_hp_koordinator', 14)->nullable();
            $table->string('nim_koordinator', 9)->nullable();


            // Blok III: Karakteristik Usaha
            // 301. Pengusaha/Penanggung Jawab Usaha
            $table->string('nama_pemilik_usaha')
                ->nullable()
                ->comment('301.a. Nama pengusaha/penanggung jawab usaha');

            $table->enum('jenis_kelamin_pemilik', ['1', '2'])
                ->nullable()
                ->comment('301.b. Jenis kelamin (1: Laki-laki, 2: Perempuan)');

            $table->integer('umur_pemilik')
                ->nullable()
                ->comment('301.c. Umur pemilik usaha');

            $table->enum('pendidikan_pemilik', ['1', '2', '3', '4', '5', '6', '7', '8'])
                ->nullable()
                ->comment('301.d. Pendidikan tertinggi (1: Tidak Tamat SD, 2: SD, 3: SMP, 4: SMA, 5: SMK, 6: D1/D2/D3, 7: D4/S1, 8: S2/S3)');

            // 302. Jenis Usaha
            $table->enum('jenis_usaha', ['1', '2', '3', '4', '5'])
                ->nullable()
                ->comment('302. Jenis usaha (1: Dalam bangunan, 2: Keliling, 3: Lokasi tetap di luar bangunan, 4: Konstruksi/tambang, 5: Persewaan)');

            // 303. Kegiatan Utama
            $table->text('jenis_kegiatan_utama')
                ->nullable()
                ->comment('303.a. Jenis kegiatan utama usaha');

            $table->string('kategori_kbli', 1)
                ->nullable()
                ->comment('303.b. Kategori KBLI');

            $table->string('kode_kbli', 5)
                ->nullable()
                ->comment('303.c. Kode KBLI 5 digit');

            // 304. Produk Utama
            $table->string('produk_utama')
                ->nullable()
                ->comment('304.a. Produk utama yang dihasilkan/dijual');

            $table->enum('klasifikasi_produk', ['1', '2'])
                ->nullable()
                ->comment('304.b. Klasifikasi produk (1: Barang, 2: Jasa)');

            // 305. Waktu Operasi
            $table->string('bulan_tahun_mulai_operasi')
                ->nullable()
                ->comment('305. Bulan dan tahun mulai beroperasi (MM/YYYY)');

            // 306. Status Badan Usaha dan Keanggotaan
            $table->enum('status_badan_usaha', ['1', '2', '3', '4', '5', '6', '7'])
                ->nullable()
                ->comment('306.a. Status badan usaha (1: PT, 2: CV, 3: Firma, 4: Koperasi, 5: Izin Khusus, 6: Perwakilan Asing, 7: Tidak Berbadan)');

            $table->enum('memiliki_akta_usaha', ['1', '2'])
                ->nullable()
                ->comment('306.b.1) Kepemilikan akta usaha (1: Ya, 2: Tidak)');

            $table->enum('anggota_asosiasi', ['1', '2'])
                ->nullable()
                ->comment('306.b.2) Keanggotaan asosiasi (1: Ya, 2: Tidak)');

            $table->string('nama_asosiasi')
                ->nullable()
                ->comment('306.b.3) Nama asosiasi jika menjadi anggota');

            $table->enum('anggota_koperasi', ['1', '2'])
                ->nullable()
                ->comment('306.c.1) Keanggotaan koperasi (1: Ya, 2: Tidak)');

            $table->json('pelayanan_koperasi')
                ->nullable()
                ->comment('306.c.2) Jenis pelayanan koperasi yang diterima {pinjaman, pengadaan, pemasaran, bimbingan, lainnya, lainnya_tuliskan}');

            // Blok IV: Kendala dan Prospek Usaha
            // Kendala
            $table->enum('kendala_permodalan', ['1', '2'])->nullable();
            $table->enum('kendala_bahan_baku', ['1', '2'])->nullable();
            $table->enum('kendala_pemasaran', ['1', '2'])->nullable();
            $table->enum('kendala_bbm_energi', ['1', '2'])->nullable();
            $table->enum('kendala_infrastruktur', ['1', '2'])->nullable();
            $table->enum('kendala_tenaga_kerja', ['1', '2'])->nullable();
            $table->enum('kendala_peraturan_birokrasi', ['1', '2'])->nullable();
            $table->enum('kendala_pungli', ['1', '2'])->nullable();
            $table->enum('kendala_pesaing', ['1', '2'])->nullable();
            $table->enum('kendala_lainnya', ['1', '2'])->nullable();
            $table->string('kendala_lainnya_tuliskan')->nullable();

            // Kredit
            $table->enum('pernah_terima_kredit', ['1', '2'])->nullable();
            $table->enum('alasan_tidak_terima_kredit', ['1', '2', '3', '4', '5', '6'])->nullable();
            $table->string('alasan_tidak_terima_kredit_lainnya')->nullable();

            // Prospek dan Pengembangan
            $table->enum('prospek_usaha', ['1', '2', '3', '4', '5'])->nullable();
            $table->enum('rencana_pengembangan', ['1', '2'])->nullable();

            // Rencana yang akan dilakukan
            $table->enum('rencana_perluas_tempat', ['1', '2'])->nullable();
            $table->enum('rencana_buka_cabang', ['1', '2'])->nullable();
            $table->enum('rencana_tingkatkan_keahlian', ['1', '2'])->nullable();
            $table->enum('rencana_diversifikasi', ['1', '2'])->nullable();
            $table->enum('rencana_lainnya', ['1', '2'])->nullable();
            $table->string('rencana_lainnya_tuliskan')->nullable();

            // Alasan tidak mengembangkan
            $table->enum('alasan_tidak_kembang', ['1', '2', '3', '4'])->nullable();
            $table->string('alasan_tidak_kembang_lainnya')->nullable();

            // Blok V: Ketenagakerjaan
            // 501. Jumlah Pekerja
            $table->integer('pekerja_tetap')->nullable();
            $table->integer('pekerja_tidak_tetap')->nullable();

            // 502. Detail Tenaga Kerja
            // 1. Jenjang Pendidikan
            // a. Tidak Tamat SD
            $table->integer('pendidikan_tsd_tetap_l')->nullable(); // Laki-laki tetap
            $table->integer('pendidikan_tsd_tetap_p')->nullable(); // Perempuan tetap
            $table->integer('pendidikan_tsd_tidak_tetap_l')->nullable(); // Laki-laki tidak tetap
            $table->integer('pendidikan_tsd_tidak_tetap_p')->nullable(); // Perempuan tidak tetap

            // b. SD dan Sederajat
            $table->integer('pendidikan_sd_tetap_l')->nullable();
            $table->integer('pendidikan_sd_tetap_p')->nullable();
            $table->integer('pendidikan_sd_tidak_tetap_l')->nullable();
            $table->integer('pendidikan_sd_tidak_tetap_p')->nullable();

            // c. SMP dan Sederajat
            $table->integer('pendidikan_smp_tetap_l')->nullable();
            $table->integer('pendidikan_smp_tetap_p')->nullable();
            $table->integer('pendidikan_smp_tidak_tetap_l')->nullable();
            $table->integer('pendidikan_smp_tidak_tetap_p')->nullable();

            // d. SMA dan Sederajat
            $table->integer('pendidikan_sma_tetap_l')->nullable();
            $table->integer('pendidikan_sma_tetap_p')->nullable();
            $table->integer('pendidikan_sma_tidak_tetap_l')->nullable();
            $table->integer('pendidikan_sma_tidak_tetap_p')->nullable();

            // e. Perguruan Tinggi
            $table->integer('pendidikan_pt_tetap_l')->nullable();
            $table->integer('pendidikan_pt_tetap_p')->nullable();
            $table->integer('pendidikan_pt_tidak_tetap_l')->nullable();
            $table->integer('pendidikan_pt_tidak_tetap_p')->nullable();

            // 2. Kelompok Umur
            // a. Kurang dari 15 tahun
            $table->integer('umur_15_kurang_tetap_l')->nullable();
            $table->integer('umur_15_kurang_tetap_p')->nullable();
            $table->integer('umur_15_kurang_tidak_tetap_l')->nullable();
            $table->integer('umur_15_kurang_tidak_tetap_p')->nullable();

            // b. 15 tahun atau lebih
            $table->integer('umur_15_lebih_tetap_l')->nullable();
            $table->integer('umur_15_lebih_tetap_p')->nullable();
            $table->integer('umur_15_lebih_tidak_tetap_l')->nullable();
            $table->integer('umur_15_lebih_tidak_tetap_p')->nullable();

            // 503. Jam Kerja
            $table->decimal('rata_rata_jam_kerja', 4, 1)->nullable();

            // 504. Pelatihan Teknologi Informasi
            $table->enum('pernah_pelatihan_ti', ['1', '2'])->nullable();
            $table->integer('jumlah_pekerja_pelatihan_ti')->nullable();

            // 505. Penggunaan Komputer dan Internet
            $table->integer('jumlah_pekerja_komputer_internet')->nullable();

            // 506. Pelatihan Aktivitas Lingkungan
            $table->enum('pernah_pelatihan_lingkungan', ['1', '2'])->nullable();
            $table->integer('jumlah_pekerja_pelatihan_lingkungan')->nullable();

            // Blok VI: Riwayat Usaha
            $table->enum('memiliki_usaha_sebelumnya', ['1', '2'])->nullable();
            $table->json('daftar_usaha_sebelumnya')->nullable();

            // Blok VII: Bahan Baku dan Pengeluaran
            $table->json('bahan_baku')->nullable();
            $table->decimal('persentase_bahan_baku_dalam_wilayah', 5, 2)->nullable();
            $table->decimal('persentase_bahan_baku_luar_wilayah', 5, 2)->nullable();
            $table->decimal('diskon', 15, 2)->nullable();
            $table->decimal('retur', 15, 2)->nullable();
            $table->decimal('biaya_tenaga_kerja_tidak_tetap', 15, 2)->nullable();
            $table->decimal('pengeluaran_lainnya', 15, 2)->nullable();

            // 901 Produksi
            $table->json('produk_terjual')->nullable();
            $table->json('produk_tidak_terjual')->nullable();

            // 902 Penjualan
            $table->decimal('penjualan_dalam_wilayah', 5, 2)->nullable();
            $table->decimal('penjualan_luar_wilayah', 5, 2)->nullable();
            $table->decimal('penjualan_konsumen_akhir', 5, 2)->nullable();
            $table->decimal('penjualan_pedagang_eceran', 5, 2)->nullable();
            $table->decimal('penjualan_pedagang_besar', 5, 2)->nullable();
            $table->decimal('penjualan_industri', 5, 2)->nullable();
            $table->decimal('penjualan_pemerintah', 5, 2)->nullable();

            // 903 Pendapatan Kategori S
            $table->decimal('pendapatan_jasa', 15, 2)->nullable();
            $table->decimal('diskon_jasa', 15, 2)->nullable();

            // 1001 Inovasi Produk
            $table->boolean('diversifikasi_produk')->nullable();
            $table->boolean('modifikasi_produk')->nullable();

            // 1002 Inovasi Proses
            $table->boolean('mesin_peralatan')->nullable();
            $table->boolean('metode_baru')->nullable();

            // 1003 Inovasi Pemasaran
            $table->boolean('media_sosial')->nullable();
            $table->boolean('ecommerce')->nullable();
            $table->boolean('desain_kemasan')->nullable();
            // $table->boolean('diskon')->nullable();

            // 1004 Inovasi Perusahaan
            $table->boolean('pemisahan_keuangan')->nullable();
            $table->boolean('pembukuan_keuangan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riset_utamas');
    }
};
