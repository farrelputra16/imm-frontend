<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundingRound extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'target',
        'announced_date',
        'money_raised',
        'lead_investor_id'
    ];

    /**
     * Relasi many-to-one dengan Company
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relasi many-to-many dengan Investment melalui pivot table funding_round_investment
     */
    public function investments()
    {
        return $this->belongsToMany(Investment::class, 'funding_round_investment')
                    ->withPivot('amount')
                    ->withTimestamps();
    }

    public function leadInvestor()
    {
        return $this->belongsTo(Investor::class, 'lead_investor_id');
    }
}
