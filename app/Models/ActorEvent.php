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
}
