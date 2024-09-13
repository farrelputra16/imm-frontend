<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['nama', 'img', 'level', 'parent_id'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function metrics()
    {
        return $this->belongsToMany(Metric::class);
    }
}
