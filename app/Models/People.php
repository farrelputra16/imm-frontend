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
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'phone_number' => 'string',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hubs()
    {
        return $this->belongsToMany(Hubs::class, 'hubs_people', 'people_id', 'hub_id');
    }
    // Relasi many-to-many dengan Company melalui tabel team
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'team')->withPivot('position')->withTimestamps();
    }
}
