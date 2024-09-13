<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'definition', 'calculation', 'usage_guidance', 'social',
        'environmental', 'section', 'subsection', 'level_type', 'related_metrics_code',
        'metric_level', 'quantity_type', 'reporting_format'
    ];

    public function relatedMetrics()
    {
        return $this->hasMany(Metric::class, 'related_metrics_code', 'code');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'metric_tag');
    }

    public function indicators()
    {
        return $this->belongsToMany(Indicator::class, 'metric_indicator');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('id', 'value', 'report_month', 'report_year', 'metric_project_id', 'created_at', 'updated_at')->using(MetricProject::class);
    }
}
