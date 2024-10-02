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
        'user_id'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi many-to-many dengan Company melalui tabel team
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'team')->withPivot('position')->withTimestamps();
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
}
