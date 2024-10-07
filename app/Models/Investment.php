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
        'status',
        'pengirim',
        'bank_asal',
        'bank_tujuan',
        'funding_type',
        'tipe_investasi'
    ];

    protected $casts = [
        'investment_date' => 'date',
    ];
    public function investor()
    {
        return $this->belongsTo(Investor::class,'investor_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
