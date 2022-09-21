<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'category'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function actor()
    {
        return $this->belongsToMany(Actor::class, 'actor_events');
    }

    public function actor_event()
    {
        return $this->hasMany(ActorEvent::class);
    }

    public function staff()
    {
        return $this->hasMany(Worker::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
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

    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($event) { // before delete() method call this
            $event->actor_event()->delete();
            // do the rest of the cleanup...
        });
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

        //versi arrow function
        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('category_id', $category)
            )
        );
    }
}
