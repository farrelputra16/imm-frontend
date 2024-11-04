<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'company_id', 'investor_id', 'people_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan perusahaan
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Relasi dengan investor
    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    // Relasi dengan people
    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
