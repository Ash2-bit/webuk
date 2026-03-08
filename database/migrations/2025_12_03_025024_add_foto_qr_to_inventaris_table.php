<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            $table->string('foto_barang')->nullable()->after('lokasi');
            $table->string('qr_code')->nullable()->after('foto_barang');
        });
    }

    public function down(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            $table->dropColumn(['foto_barang', 'qr_code']);
        });
    }
};

