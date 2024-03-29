<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Character extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    public function actor()
    {
        return $this->hasMany(Actor::class);
    }

    public function actor_event()
    {
        return $this->hasManyThrough(ActorEvent::class, Actor::class);
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

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                // ->orWhere('synopsis', 'like', '%' . $search . '%')
            });
        });
    }
}
