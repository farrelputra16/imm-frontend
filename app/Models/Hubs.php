<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hubs extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'provinsi',
        'kota',
        'rank',
        'top_investor_types',
        'top_funding_types',
        'description',
        'status',
    ];

    protected $casts = [
        'rank' => 'integer',
    ];

    // Default status adalah 'pending' jika tidak ditentukan
    protected $attributes = [
        'status' => 'pending',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
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
    // Scope untuk mengambil hubs dengan status 'approved'
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
