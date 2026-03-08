<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $fillable = [
        'nama_barang', 'jumlah', 'kondisi', 'tanggal_masuk', 'lokasi', 'link_sop',         'foto_barang','qr_code', 'status_peminjaman',
        'ketersediaan',
    ];
}

