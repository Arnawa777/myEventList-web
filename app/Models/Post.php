<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'event', 'topic', 'author'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    //user diganti menjadi author
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
