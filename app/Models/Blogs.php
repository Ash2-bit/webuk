<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    protected $fillable = [
        'judul', 'slug', 'gambar', 'konten', 'penulis'
    ];
    public function comments() {
    return $this->hasMany(BlogComment::class, 'blogs_id')->latest();}
}
