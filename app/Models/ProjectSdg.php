<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectSdg extends Pivot
{
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function sdg()
    {
        return $this->belongsTo(Sdg::class);
    }

    public function parentSdgProject()
    {
        return $this->belongsTo(ProjectSdg::class, 'sdg_id');
    }

    public function childSdgProjects()
    {
        return $this->hasMany(ProjectSdg::class, 'sdg_id');
    }
}
