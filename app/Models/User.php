<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'img',
        'password',
        'nama_depan',
        'nama_belakang',
        'nik',
        'negara',
        'provinsi',
        'alamat',
        'telepon',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        if (is_null($this->nama_belakang)) {
            return "{$this->nama_depan}";
        }

        return "{$this->nama_depan}";
    }
    /**
     * Set the default role for the user.
     *
     * @param string $value
     * @return void
     */
    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = in_array($value, ['ADMIN', 'USER', 'INVESTOR', 'EVENT ORGANIZER', 'PEOPLE']) ? $value : 'USER';
    }
    public function people()
    {
        return $this->hasOne(People::class, 'user_id');
    }
    public function investor()
    {
        return $this->hasOne(Investor::class, 'user_id');
    }
    public function companies()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

   // Di dalam model User.php
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id');
    }

    public function add_event()
    {
        return $this->belongsToMany(Event::class, 'user_event');
    }

    // Relasi one-to-many dengan Wishlist
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
