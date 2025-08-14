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
        Schema::create('riset5s', function (Blueprint $table) {
            $table->id();

            //BLOK I: Identitas
            $table->string('jenis_kelamin');
            $table->string('kelas');
            $table->string('pengalaman_capi/papi');

            //BLOK II: Information Quality
            $table->string('informasi_relevan');
            $table->string('informasi_up_to_date');
            $table->string('progress_pencacahan');
            $table->string('output_tidak_ambigu');

            //BLOK III: System Quality
            $table->string('fitur_mendukung');
            $table->string('mudah_digunakan');
            $table->string('respon_cepat');
            $table->string('pengisian_mudah');

            //BLOK IV. Service Quality
            $table->string('help_desk');
            $table->string('petunjuk_jelas');
            $table->string('kenyamanan');

            //BLOK V: Content
            $table->string('isi_lengkap');
            $table->string('informasi_benar');
            $table->string('informasi_presisi');
            $table->string('mudah_dipahami');

            //BLOK VI: Format
            $table->string('desain_menarik');
            $table->string('tata_letak_baik');
            $table->string('menu_teratur');

            //BLOK VII: User Satisfaction
            $table->string('puas_data');
            $table->string('puas_efektivitas');
            $table->string('puas_efisiensi');
            $table->string('puas_umum');

            //BLOK VIII: Net Benefits
            $table->string('kinerja_lebih_baik');
            $table->string('lebih_mudah');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riset5s');
    }
};
