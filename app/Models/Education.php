<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations'; // Menentukan tabel yang benar

    protected $fillable = [
        'people_id',
        'university',
        'title',
        'field_of_study',
        'location',
        'start_date',
        'end_date',
        'grade',
        'activities',
        'description',
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }
}
