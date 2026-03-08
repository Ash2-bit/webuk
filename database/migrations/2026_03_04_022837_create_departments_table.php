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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabinet_id')->constrained()->onDelete('cascade');
            $table->string('nama_bidang');
            
            $table->string('co_ikhwan');
            $table->string('foto_co_ikhwan')->nullable(); // Foto Co Ikhwan
            $table->string('npm_co_ikhwan')->nullable();
            $table->string('prodi_co_ikhwan')->nullable();

            $table->string('co_akhwat');
            $table->string('foto_co_akhwat')->nullable(); // Foto Co Akhwat
            $table->string('npm_co_akhwat')->nullable();
            $table->string('prodi_co_akhwat')->nullable();
            
            $table->text('deskripsi')->nullable();
            $table->text('anggota_aktif')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
