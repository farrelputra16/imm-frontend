<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyFinance extends Model
{
    use HasFactory;
    protected $table = 'company_finance';
    protected $fillable = [
        'company_id',
        'total_pendapatan',
        'laba_kotor',
        'laba_usaha',
        'laba_sebelum_pajak',
        'laba_bersih_tahun_berjalan',
        'status_quarter',
        'tahun',
        'created_at',
        'updated_at'
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
