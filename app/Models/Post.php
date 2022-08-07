<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Get one Last Post
    public function latestComment()
    {
        return $this->hasOne(Comment::class)->latest('created_at');
    }


    //penggantian id menjadi slug {{-- Menit 36 eps 17 --}}
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Otomatis membuat slug
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
