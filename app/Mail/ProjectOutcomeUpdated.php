<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\CompanyOutcome;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProjectOutcomeUpdated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $outcome;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CompanyOutcome $outcome)
    {
         $this->outcome = $outcome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.project_outcome_updated')
                    ->subject('Update Pengeluaran Proyek')
                    ->with([
                        'projectName' => $this->outcome->project->nama,
                        'date' => $this->outcome->date,
                        'amount' => $this->outcome->jumlah_biaya,
                    ]);
    }
}
