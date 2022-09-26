<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $with = [
        'event', 'person'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function scopeFilter($query, array $filters)
    {
        //versi arrow function
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => $query->where('role', 'like', '%' . $search . '%')
                ->orwhereHas('event', fn ($query) =>
                $query->where('name', 'like', '%' .  $search . '%'))
                ->orWhereHas('person', fn ($query) =>
                $query->where('name', 'like', '%' .  $search . '%'))
        );
    }
}
