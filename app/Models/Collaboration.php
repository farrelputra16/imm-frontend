<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'title',
        'image',
        'description',
        'position',
    ];

    /**
     * Relasi ke tabel Company (One to Many)
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relasi ke tabel CollaborationApplicant (One to Many)
     */
    public function applicants()
    {
        return $this->hasMany(CollaborationApplicant::class);
    }

    /**
     * Mengubah field 'position' menjadi array
     */
    public function getPositionArrayAttribute()
    {
        return explode(',', $this->position);
    }

    /**
     * Menyimpan posisi dengan format koma
     */
    public function setPositionArrayAttribute($value)
    {
        $this->attributes['position'] = implode(',', $value);
    }
}
