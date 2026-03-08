<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable; // Tambahan: Untuk fitur pengiriman email
use Illuminate\Contracts\Auth\CanResetPassword; // Tambahan: Interface reset password
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait; // Tambahan: Trait reset password

class UserAnggota extends Authenticatable implements CanResetPassword
{
    // Tambahkan Notifiable dan CanResetPasswordTrait di sini
    use HasFactory, Notifiable, CanResetPasswordTrait;

    protected $table = 'user_anggotas';

    protected $fillable = [
        'nama',
        'npm',
        'tahun_masuk',
        'jurusan',
        'prodi',
        'ldf',
        'genre',
        'tanggal_lahir',
        'alamat',
        'foto',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}