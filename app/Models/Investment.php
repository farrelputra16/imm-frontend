<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FundingRound;

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
        'funding_round_id' // Pastikan ada funding_round_id
    ];

    protected $casts = [
        'investment_date' => 'date',
        'amount' => 'integer',
    ];

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'investor_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function fundingRound()
    {
        return $this->belongsTo(FundingRound::class);
    }

    // Event Eloquent untuk menambah dan mengurangi amount ke money_raised
    protected static function booted()
    {
        // Ketika investasi dibuat
        static::created(function ($investment) {
            $fundingRound = FundingRound::find($investment->funding_round_id);

            if ($fundingRound) {
                // Jika money_raised null, inisialisasi dengan 0
                $fundingRound->money_raised = $fundingRound->money_raised ?? 0;
                // Tambahkan nilai amount investasi ke money_raised
                $fundingRound->money_raised += $investment->amount;
                $fundingRound->save();
            }
        });

        // Ketika investasi dihapus
        static::deleted(function ($investment) {
            $fundingRound = FundingRound::find($investment->funding_round_id);

            if ($fundingRound) {
                // Kurangi nilai amount investasi dari money_raised
                $fundingRound->money_raised -= $investment->amount;
                $fundingRound->save();
            }
        });

        // Ketika investasi diupdate
        static::updated(function ($investment) {
            $originalAmount = $investment->getOriginal('amount');
            $fundingRound = FundingRound::find($investment->funding_round_id);

            if ($fundingRound) {
                // Kurangi amount lama dan tambahkan amount baru
                $fundingRound->money_raised -= $originalAmount;
                $fundingRound->money_raised += $investment->amount;
                $fundingRound->save();
            }
        });
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
