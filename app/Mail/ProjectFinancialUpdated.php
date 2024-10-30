<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\CompanyFinance;
use Illuminate\Queue\SerializesModels;

class ProjectFinancialUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $financial;
    public $investorName; // Tambahkan variabel untuk nama investor

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CompanyFinance $financial, $investorName)
    {
        $this->financial = $financial;
        $this->investorName = $investorName; // Simpan nama investor
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.financial_outcome_updated')
            ->subject('Update Laporan Keuangan Perusahaan')
            ->with([
                'Quarter' => $this->financial->status_quarter,
                'Year' => $this->financial->tahun,
                'Company' => $this->financial->company->nama, // Mengambil nama perusahaan
                'TotalPendapatan' => number_format($this->financial->total_pendapatan, 2, ',', '.'), // Format total pendapatan
                'LabaKotor' => number_format($this->financial->laba_kotor, 2, ',', '.'), // Format laba kotor
                'LabaBersih' => number_format($this->financial->laba_bersih_tahun_berjalan, 2, ',', '.'), // Format laba bersih
                'InvestorName' => $this->investorName, // Tambahkan nama investor ke data yang dikirim ke view
            ]);
    }
}
