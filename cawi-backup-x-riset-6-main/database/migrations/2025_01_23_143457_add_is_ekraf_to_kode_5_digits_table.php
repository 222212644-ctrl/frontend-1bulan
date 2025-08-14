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
        Schema::table('kode5_digit', function (Blueprint $table) {
            $table->boolean('is_ekraf')->default(0)->after('description_generate'); // Letakkan setelah kolom 'description_generate'
        });
    }
    
    public function down(): void
    {
        Schema::table('kode5_digit', function (Blueprint $table) {
            $table->dropColumn('is_ekraf');
        });
    }    
};
