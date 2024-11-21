<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'primary_job_title',
        'primary_organization', // ini merujuk ke id dari companies atau nullable
        'location',
        'regions',
        'gender', // enum('Laki-laki', 'Perempuan')
        'linkedin_link',
        'description',
        'phone_number',
        'gmail', // harus unik
        'user_id',
        'skills'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi many-to-many dengan Company melalui tabel team
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'team', 'people_id', 'company_id')
                    ->withPivot(['position', 'primary_job_title', 'image'])
                    ->withTimestamps();
    }

    // Relasi many-to-many dengan Hubs melalui tabel hubs_people
    public function hubs()
    {
        return $this->belongsToMany(Hubs::class, 'hubs_people', 'people_id', 'hub_id');
    }

    // Set gender enum value
    public function setGenderAttribute($value)
    {
        if (!in_array($value, ['Laki-laki', 'Perempuan'])) {
            throw new \InvalidArgumentException('Invalid gender value');
        }
        $this->attributes['gender'] = $value;
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'primary_organization');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
    public function education()
    {
        return $this->hasMany(Education::class);
    }
    public function collaborationApplicants()
    {
        return $this->hasMany(collaborationApplicant::class);
    }
}
