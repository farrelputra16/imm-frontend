<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table = 'team'; // Explicitly define the table if needed
    protected $fillable = ['company_id', 'people_id', 'position'];
}
