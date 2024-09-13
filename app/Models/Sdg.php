<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sdg extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'img','name', 'order', 'description'
    ];

    public function indicators()
    {
        return $this->hasMany(Indicator::class);
    }
}
