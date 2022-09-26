<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;



class Category extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];


    public function events()
    {
        return $this->hasMany(Event::class);
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
            $query->where('name', 'like', '%' .  $search . '%')
        );
    }
}
