<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'person', 'character'
    ];

    public function event()
    {
        return $this->belongsToMany(Event::class, 'actor_events');
    }

    public function actor_event()
    {
        return $this->hasMany(ActorEvent::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function scopeFilter($query, array $filters)
    {
        //versi arrow function
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query->whereHas('person', fn ($query) =>
            $query->where('name', 'like', '%' .  $search . '%'))
                ->orWhereHas('character', fn ($query) =>
                $query->where('name', 'like', '%' .  $search . '%'))
        );

        //versi arrow function
        $query->when(
            $filters['role'] ?? false,
            fn ($query, $role) => $query->whereHas('character', fn ($query) =>
            $query->where('role', $role))
        );
    }
}
