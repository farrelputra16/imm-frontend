<?php

namespace App\Models;

use App\Models\User;
use App\Models\Investor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hubs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'provinsi',
        'kota',
        'description',
        'facilities',
        'programs',
        'alumni',
        'status',
        'user_id',
        'type_of_service',
        'purpose',
        'target_scale',
        'location_size',
        'operating_hours',
        'market_and_promotion_plan',
        'target_participant',
        'estimated_user',
        'benefit',
        'estimated_setup_cost',
        'funding_sources',
        'investor_id'
    ];

    protected $casts = [
        'rank' => 'integer',
        'estimated_user' => 'integer',
        'estimated_setup_cost' => 'decimal:2',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_hubs', 'hub_id', 'company_id');
    }

    public function people()
    {
        return $this->belongsToMany(People::class, 'hubs_people', 'hub_id', 'people_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_hubs', 'hub_id', 'event_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
