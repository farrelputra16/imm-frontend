<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'people_id',
        'position',
        'type_of_work',
        'start_date',
        'end_date',
        'description',
    ];

    /**
     * Get the company that owns the experience.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the person (people) that owns the experience.
     */
    public function people()
    {
        return $this->belongsTo(People::class, 'people_id');
    }
}
