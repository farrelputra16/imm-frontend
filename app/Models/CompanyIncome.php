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
    ];

    /**
     * Get the company that owns the income.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}