<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyOutcome extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_outcome';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'jumlah_biaya',
        'category',
        'keterangan',
        'bukti',
        'project_id',
    ];

    /**
     * Get the project that owns the outcome.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    
}
