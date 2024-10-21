<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyIncome extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_income';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'pengirim',
        'bank_asal',
        'bank_tujuan',
        'jumlah',
        'company_id',
        'funding_type',
        'tipe_investasi',
        'project_id',
    ];

    /**
     * Get the company that owns the income.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function getInvestmentTypeLabelAttribute()
    {
        $investmentTypes = [
            'venture_capital' => 'Venture Capital',
            'individual_angel' => 'Individual/Angel',
            'private_equity_firm' => 'Private Equity Firm',
            'accelerator' => 'Accelerator',
            'investment_partner' => 'Investment Partner',
            'corporate_venture_capital' => 'Corporate Venture Capital',
            'micro_vc' => 'Micro VC',
            'angel_group' => 'Angel Group',
            'incubator' => 'Incubator',
            'investment_bank' => 'Investment Bank',
            'family_investment_office' => 'Family Investment Office',
            'venture_debt' => 'Venture Debt',
            'co_working_space' => 'Co-Working Space',
            'fund_of_funds' => 'Fund Of Funds',
            'hedge_fund' => 'Hedge Fund',
            'government_office' => 'Government Office',
            'university_program' => 'University Program',
            'entrepreneurship_program' => 'Entrepreneurship Program',
            'secondary_purchaser' => 'Secondary Purchaser',
            'startup_competition' => 'Startup Competition',
            'syndicate' => 'Syndicate',
            'pension_funds' => 'Pension Funds',
        ];

        return $investmentTypes[$this->tipe_investasi] ?? ucfirst(str_replace('_', ' ', $this->tipe_investasi));
    }
}
