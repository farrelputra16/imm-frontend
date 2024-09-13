<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'topic',
        'location',
        'start',
        'end',
        'deadline',
        'img',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}