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
}
