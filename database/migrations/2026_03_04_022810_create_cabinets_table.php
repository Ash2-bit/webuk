<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cabinets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kabinet');
            $table->string('tahun');
            $table->text('deskripsi')->nullable();
            $table->string('logo')->nullable();
            
            $table->string('ketua')->nullable();
            $table->string('npm_ketua')->nullable(); // Baru
            $table->string('prodi_ketua')->nullable(); // Baru
            $table->string('foto_ketua')->nullable();

            // Tambahkan untuk Keputrian (Samping Ketua Umum)
            $table->string('keputrian')->nullable();
            $table->string('npm_keputrian')->nullable();
            $table->string('prodi_keputrian')->nullable();
            $table->string('foto_keputrian')->nullable();

            $table->string('sekretaris')->nullable();
            $table->string('npm_sekretaris')->nullable();
            $table->string('prodi_sekertaris')->nullable();
            $table->string('foto_sekretaris')->nullable();

            $table->string('bendahara')->nullable();
            $table->string('npm_bendahara')->nullable();
            $table->string('prodi_bendahara')->nullable();
            $table->string('foto_bendahara')->nullable();
            
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabinets');
    }
};
