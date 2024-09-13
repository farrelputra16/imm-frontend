<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class MetricProject extends Pivot
{
    protected $fillable = ['project_id', 'metric_id', 'value', 'report_month', 'report_year', 'metric_project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function metric()
    {
        return $this->belongsTo(Metric::class);
    }

    public function parentMetricProject()
    {
        return $this->belongsTo(MetricProject::class, 'metric_project_id');
    }

    public function childMetricProjects()
    {
        return $this->hasMany(MetricProject::class, 'metric_project_id');
    }
}
