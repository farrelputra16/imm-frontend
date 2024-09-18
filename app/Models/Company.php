<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'profile',
        'founded_date',
        'tipe',
        'nama_pic',
        'posisi_pic',
        'telepon',
        'negara',
        'provinsi',
        'kabupaten',
        'jumlah_karyawan',
        'startup_summary',
        'user_id',
    ];

    /**
     * Get the projects associated with the company.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the user that owns the company.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function incomes()
    {
        return $this->hasMany(CompanyIncome::class);
    }
    public static function getFilteredCompanies($request = null)
    {
        // Query utama dengan relasi
        $query = self::with(['incomes' => function($query) {
            // Ambil income terbaru berdasarkan tanggal
            $query->orderBy('date', 'desc');
        }, 'projects' => function($query) {
            // Ambil proyek terbaru (MAX id berarti proyek terbaru per company_id)
            $query->whereIn('id', function($subQuery) {
                $subQuery->selectRaw('MAX(id)')
                        ->from('projects')
                        ->groupBy('company_id');
            })
            ->with(['dana' => function($query) {
                // Urutkan dana berdasarkan created_at untuk ambil dana terbaru
                $query->orderBy('created_at', 'desc');
            }]);
        }]);

        // Kondisi pencarian berdasarkan lokasi
        if($request){
            if($request->has('location') && !empty($request->location)) {
                $query->where('kabupaten', 'like', '%'.$request->location.'%');
            }
    
            // Kondisi pencarian berdasarkan industri
            if($request->has('industry') && !empty($request->industry)) {
                $query->where('tipe', 'like', '%'.$request->industry.'%');
            }
    
            // Kondisi pencarian berdasarkan model bisnis (departemen)
            if($request->has('departments') && !empty($request->departments)) {
                $query->where('posisi_pic', 'like', '%'.$request->departments.'%');
            }
        }

        // Eksekusi query setelah semua filter ditambahkan
        $companies = $query->get();

        // Iterate setiap perusahaan dan atur income terbaru dan dana terbaru untuk proyek
        $companies->each(function($company) {
            // Ambil income terbaru untuk perusahaan
            $company->latest_income_date = $company->incomes->first() ? $company->incomes->first()->date : null;

            // Ambil proyek terbaru untuk perusahaan dan dana terbaru
            $latest_project = $company->projects->first(); // Hanya ambil proyek terbaru
            if ($latest_project) {
                $company->latest_project_dana = $latest_project->dana->first(); // Ambil dana terbaru dari proyek
            } else {
                $company->latest_project_dana = null;
            }
        });

        return $companies;
    }
}
