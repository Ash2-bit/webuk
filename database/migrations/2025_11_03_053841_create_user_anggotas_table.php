<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('npm')->unique();
            $table->year('tahun_masuk');
            $table->string('jurusan');
            $table->string('prodi');
            $table->enum('ldf', [
                'FKSI', 
                'FOSI', 
                'FIMADINA',
                'GSI',
                'IMC', 
                'WAMI',
                'MGC',
                'MOSTANEER',
                'TIDAK ADA'
            ])->nullable();
            $table->enum('genre', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('foto')->nullable(); // opsional
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_anggotas');
    }
};
