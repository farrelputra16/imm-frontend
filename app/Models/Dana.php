<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_dana',
        'nominal',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
