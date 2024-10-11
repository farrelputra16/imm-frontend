<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'nama',
        'profile',
        'founded_date',
        'business_model', // Pastikan ini ada di sini
        'nama_pic',
        'posisi_pic',
        'telepon',
        'negara',
        'provinsi',
        'kabupaten',
        'jumlah_karyawan',
        'startup_summary',
        'funding_stage',
    ];
    /**
     * Get the projects associated with the company.
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the hubs associated with the company.
     */
    public function hubs()
    {
        return $this->belongsToMany(Hubs::class, 'company_hubs', 'company_id', 'hub_id');
    }

    /**
     * Get the user that owns the company.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke Incomes
     */
    public function incomes()
    {
        return $this->hasMany(CompanyIncome::class);
    }

    /**
     * Relasi many-to-many dengan People melalui tabel team
     */
    public function teamMembers()
    {
        return $this->belongsToMany(People::class, 'team')->withPivot('position')->withTimestamps();
    }

    /**
     * Relasi many-to-many dengan Department melalui tabel company_departments
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'company_departments');
    }

    /**
     * Method untuk mendapatkan perusahaan berdasarkan filter lokasi, industri, atau funding type.
     */
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
            });
        }]);

        // Kondisi pencarian berdasarkan lokasi
        if ($request) {
            if ($request->has('location') && !empty($request->location)) {
                $query->where('kabupaten', 'like', '%' . $request->location . '%');
            }

            // Kondisi pencarian berdasarkan industri
            if ($request->has('industry') && !empty($request->industry)) {
                $query->where('tipe', 'like', '%' . $request->industry . '%');
            }

            // Kondisi pencarian berdasarkan model bisnis (departemen)
            if ($request->has('departments') && !empty($request->departments)) {
                $query->where('posisi_pic', 'like', '%' . $request->departments . '%');
            }

            if (isset($request->funding_type)) {
                $query->whereHas('incomes', function($query) use ($request) {
                    $query->where('funding_type', $request->funding_type);
                });
            }
        }

        // Eksekusi query setelah semua filter ditambahkan
        $companies = $query->get();

        // Iterate setiap perusahaan dan atur income terbaru dan dana terbaru untuk proyek
        $companies->each(function($company) {
            // Ambil income terbaru untuk perusahaan
            $company->latest_income_date = $company->incomes->first() ? $company->incomes->first()->date : null;
            $company->latest_funding_type = $company->incomes->first() ? $company->incomes->first()->funding_type : null;
        });

        return $companies;
    }
}
