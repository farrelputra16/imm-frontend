<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hubs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
        'number_of_organizations',
        'number_of_people',
        'number_of_events',
        'rank',
        'top_investor_types',
        'top_funding_types',
        'description',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'number_of_organizations' => 'integer',
        'number_of_people' => 'integer',
        'number_of_events' => 'integer',
        'rank' => 'integer',
    ];
}
