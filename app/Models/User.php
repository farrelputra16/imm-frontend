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
        'email', 'img', 'password', 'nama_depan', 'nama_belakang', 'nik', 'negara', 'provinsi', 'alamat', 'telepon', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * Set the user's password.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

     /**
     * Set the default role for the user.
     *
     * @param string $value
     * @return void
     */
    public function setRoleAttribute($value)
    {
        $this->attributes['role'] = in_array($value, ['ADMIN', 'USER']) ? $value : 'USER';
    }

    public function companies()
    {
        return $this->hasOne(Company::class, 'user_id');
    }

    public function events()
    {
    return $this->belongsToMany(Event::class); 
}
}