<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectDokumen extends Pivot
{
    protected $table = 'project_dokumen';
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

}
