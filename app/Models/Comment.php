<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'post', 'author'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //user diganti menjadi author
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
