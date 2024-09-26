<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'topic',
        'location',
        'start',
        'end',
        'deadline',
        'img',
    ];

    public function hubs()
    {
        return $this->belongsToMany(Hubs::class, 'event_hubs', 'event_id', 'hub_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
