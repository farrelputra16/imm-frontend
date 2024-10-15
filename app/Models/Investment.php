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
        'amount',
        'investment_date',
        'status',
        'pengirim',
        'bank_asal',
        'bank_tujuan',
        'funding_type',
        'tipe_investasi',
        'funding_round_id' // Tambahkan funding_round_id di sini
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

    public function fundingRound()
    {
        return $this->belongsTo(FundingRound::class);
    }
}
