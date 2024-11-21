<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollaborationApplicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'collaboration_id',
        'people_id',
        'name',
        'position',
        'resume',
        'status'
    ];

    /**
     * Relasi ke tabel Collaboration (Many to One)
     */
    public function collaboration()
    {
        return $this->belongsTo(Collaboration::class);
    }

    /**
     * Relasi ke tabel People (Many to One)
     */
    public function people()
    {
        return $this->belongsTo(People::class);
    }

    /**
     * Untuk menyimpan file resume
     */
    public function setResumeAttribute($value)
    {
        if (is_file($value)) {
            // Simpan file ke storage/public
            $this->attributes['resume'] = $value->store('resumes', 'public');
        }
    }
}
