<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Topic extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Get one Last Post
    public function latestPost()
    {
        return $this->hasOne(Post::class)->latest('created_at');
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

    public function scopeFilter($query, array $filters)
    {
        //versi arrow function
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('topic', 'like', '%' .  $search . '%')
                ->orWhere('sub_topic', 'like', '%' .  $search . '%')
        );
    }
}
