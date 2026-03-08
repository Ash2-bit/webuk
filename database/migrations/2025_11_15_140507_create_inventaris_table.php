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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('kondisi')->default('baik');
            $table->date('tanggal_masuk')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('link_sop')->nullable();
            $table->enum('status_peminjaman', ['boleh', 'tidak_boleh'])->default('boleh');
            $table->enum('ketersediaan', ['ada', 'tidak_ada', 'tidak_dapat_dipinjam'])->default('ada');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaris');
    }
};
