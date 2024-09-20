<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'role',
        'primary_job_title',
        'primary_organization',
        'location',
        'regions',
        'gender',
        'linkedin_link',
        'description',
        'phone_number',
        'gmail',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'phone_number' => 'string',
    ];

    // Relationship with Company through Team
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'team')->withPivot('position');
    }
}
