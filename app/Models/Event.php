<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $keyType = 'int'; // Assuming 'id' is an integer now
    public $incrementing = true; // Since 'id' is AUTO_INCREMENT

    protected $fillable = [
        'title',
        'description',
        'allowed_participants',
        'expected_participants',
        'fee_type',
        'organizer_name',
        'email',
        'nomor_tlpn',
        'topic',
        'location',
        'start',
        'event_duration',
        'cover_img',
        'hero_img',
    ];

    public function hubs()
    {
        return $this->belongsToMany(Hubs::class, 'event_hubs', 'event_id', 'hub_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id');
    }
    public function add_user()
    {
        return $this->belongsToMany(User::class, 'user_event');
    }
}
