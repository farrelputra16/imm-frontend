<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'org_name',
        'number_of_contacts',
        'location',
        'description',
        'departments',
        'investment_stage',
        'user_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'number_of_contacts' => 'integer',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Company untuk mendapatkan nama perusahaan.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'org_name', 'id');
    }

    /**
     * Accessor untuk menghitung number_of_investments dari tabel investments
     */
    public function getNumberOfInvestmentsAttribute()
    {
        return $this->investments()->count();
    }

    /**
     * Relasi ke Investments
     */
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
