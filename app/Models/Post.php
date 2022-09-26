<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Auth;

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

    public function scopeFilter($query, array $filters)
    {

        //Null Coalescing operator
        /* 
        Penyederhanaan Ternary 

        ?? = jika ada kembalikan $filters... jika tidak false
        $filters['search'] ?? false
        */



        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhereHas('author', fn ($query) =>
                $query->where('username', 'like', '%' .  $search . '%'))
        );

        //versi arrow function
        $query->when(
            $filters['topic'] ?? false,
            fn ($query, $topic) => $query->whereHas('topic', fn ($query) =>
            $query->where('id', $topic))
        );

        // $request = request('user');
        // $auth = Auth::user()->username;

        // if ($request == 1) {
        //     $query->when(
        //         $filters['user'] ?? false,
        //         fn ($query, $auth) => $query->whereHas('author', fn ($query) =>
        //         $query->where('id', $auth))
        //     );
        // } elseif ($request == 2) {
        //     $query->when(
        //         $filters['user'] ?? false,
        //         fn ($query, $auth) => $query->whereHas('author', fn ($query) =>
        //         $query->where('id', '!==', $auth))
        //     );
        // }
    }
}
