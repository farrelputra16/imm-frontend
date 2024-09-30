<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'company_id',
        'project_id',
        'amount',
        'investment_date',
        'status'
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
