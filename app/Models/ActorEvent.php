<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorEvent extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'event', 'actor'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function actor()
    {
        return $this->belongsTo(Actor::class);
    }

    public function scopeFilter($query, array $filters)
    {
        //versi arrow function
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query->where('role', 'like', '%' .  $search . '%')
                ->orwhereHas('event', fn ($query) =>
                $query->where('name', 'like', '%' .  $search . '%'))
                ->orWhereHas(
                    'actor',
                    fn ($query) =>
                    $query->whereHas('character', fn ($query) =>
                    $query->where('name', 'like', '%' .  $search . '%')->orWhere('role', 'like', '%' . $search . '%'))
                        ->orWhereHas('person', fn ($query) => $query->where('name', 'like', '%' . $search . '%'))
                )
        );
    }
}
