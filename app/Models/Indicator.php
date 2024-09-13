<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $fillable = [
        'name', 'order', 'level', 'parent_indicator_id', 'sdg_id', 'description'
    ];

    public function parentIndicator()
    {
        return $this->belongsTo(Indicator::class, 'parent_indicator_id');
    }

    public function childIndicators()
    {
        return $this->hasMany(Indicator::class, 'parent_indicator_id');
    }

    public function sdgs()
    {
        return $this->belongsTo(Sdg::class);
    }

    public function metrics()
    {
        return $this->belongsToMany(Metric::class,'metric_indicator');
    }
}
