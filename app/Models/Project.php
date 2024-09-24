<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MattDaneshvar\Survey\Models\Survey;

class Project extends Model
{
    protected $fillable = ['img', 'nama', 'deskripsi', 'tujuan', 'start_date', 'end_date', 'provinsi', 'kota', 'gmaps', 'jumlah_pendanaan', 'status', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function fundings()
    {
        return $this->hasMany(Funding::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function sdgs()
    {
        return $this->belongsToMany(Sdg::class)->with('indicators');
    }

    public function metrics()
    {
        return $this->belongsToMany(Metric::class)->withPivot('id', 'value', 'report_month', 'report_year', 'metric_project_id', 'created_at', 'updated_at')->using(MetricProject::class);
    }

    public function indicators()
    {
        return $this->belongsToMany(Indicator::class);
    }


    public function targetPelanggan()
    {
        return $this->hasMany(TargetPelanggan::class);
    }
    public function dana()
    {
        return $this->hasMany(Dana::class);
    }

    public function metricProjects()
    {
        return $this->hasMany(MetricProject::class);
    }
    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }
    public function indicatorProjects()
    {
        return $this->hasMany(IndicatorProject::class);
    }
    public function projectSdg()
    {
        return $this->hasMany(ProjectSdg::class);
    }
    public function survey()
    {
        return $this->hasMany(Survey::class);
    }
    public function projectDokumen()
    {
        return $this->hasMany(ProjectDokumen::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relasi one-to-many dengan Wishlist
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

}

