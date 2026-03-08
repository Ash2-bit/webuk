<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = ['blogs_id', 'nama', 'email', 'komentar'];

    public function blog()
    {
        return $this->belongsTo(Blogs::class, 'blogs_id');
    }
}
