<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'user_id',
        'survey_id',
    ];

    /**
     * Get the user that owns the response.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the survey that owns the response.
     */
    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
