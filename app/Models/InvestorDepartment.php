<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorDepartment extends Model
{
    use HasFactory;
    protected $fillable = ['investor_id', 'department_id'];
}
