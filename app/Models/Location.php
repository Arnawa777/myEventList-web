<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];
    //not use
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function scopeFilter($query, array $filters)
    {
        //versi arrow function
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('regency', 'like', '%' .  $search . '%')
                ->orWhere('sub_regency', 'like', '%' . $search . '%')
        );
    }
}
