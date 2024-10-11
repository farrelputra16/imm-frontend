<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
     * Get the companies that belong to the department.
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_departments');
    }
}
