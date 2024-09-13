<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class IndicatorProject extends Pivot
{
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function indicator()
    {
        return $this->belongsTo(Indicator::class);
    }

    public function parentIndicatorProject()
    {
        return $this->belongsTo(IndicatorProject::class, 'indicator_id');
    }

    public function childIndicatorProjects()
    {
        return $this->hasMany(IndicatorProject::class, 'indicator_id');
    }
}
