<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'name',
        'description',
        'price',
        'image', 
    ];
    // Hubungan dengan Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
