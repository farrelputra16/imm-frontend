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
     * Relasi one-to-many dengan Wishlist
    */
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Method untuk mendapatkan perusahaan berdasarkan filter lokasi, industri, atau funding type.
     */
    public static function getFilteredCompanies($request = null)
    {
        // Query utama untuk mengambil perusahaan dengan relasi yang diperlukan
        $query = self::with('departments');

        // Kondisi pencarian berdasarkan lokasi
        if ($request) {
            if ($request->input('location') && !empty($request->input('location'))) {
                $query->where('kabupaten', 'like', '%' . $request->input('location') . '%');
            }

            // Kondisi pencarian berdasarkan industri
            if ($request->input('industry') && !empty($request->input('industry'))) {
                $query->where('tipe', 'like', '%' . $request->input('industry') . '%');
            }

            // Kondisi pencarian berdasarkan model bisnis (departemen)
            if ($request->input('departments') && !empty($request->input('departments'))) {
                $query->whereHas('departments', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->input('departments') . '%');
                });
            }

            // Kondisi pencarian berdasarkan jenis pendanaan
            if ($request->input('funding_type')) {
                $query->whereHas('incomes', function ($query) use ($request) {
                    $query->where('funding_type', $request->input('funding_type'));
                });
            }
        }

        // Ambil semua perusahaan yang telah difilter
        $companies = $query->get();

        // Iterasi setiap perusahaan dan ambil dua nama departemen teratas
        $companies->each(function ($company) {
            // Ambil dua nama departemen teratas
            $company->departments = $company->departments->take(2)->pluck('name');
            $company->latest_funding_date = $company->fundingRounds->max('announced_date');
        });

        return $companies;
    }

    public static function getFilteredCompaniesPaginated($request = null, $rowsPerPage = 10)
    {
        // Ambil semua perusahaan
        $query = self::query();

        // Pencarian global
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', "%{$searchTerm}%")
                ->orWhere('profile', 'like', "%{$searchTerm}%")
                ->orWhere('business_model', 'like', "%{$searchTerm}%")
                ->orWhere('founded_date', 'like', "%{$searchTerm}%")
                ->orWhere('nama_pic', 'like', "%{$searchTerm}%")
                ->orWhere('posisi_pic', 'like', "%{$searchTerm}%")
                ->orWhere('telepon', 'like', "%{$searchTerm}%")
                ->orWhere('negara', 'like', "%{$searchTerm}%")
                ->orWhere('provinsi', 'like', "%{$searchTerm}%")
                ->orWhere('kabupaten', 'like', "%{$searchTerm}%")
                ->orWhere('jumlah_karyawan', 'like', "%{$searchTerm}%")
                ->orWhere('startup_summary', 'like', "%{$searchTerm}%")
                ->orWhere('funding_stage', 'like', "%{$searchTerm}%");
                // Tambahkan kolom lain yang ingin dicari
            });
        }

        // Kondisi pencarian berdasarkan lokasi
        if ($request->input('location') && !empty($request->input('location'))) {
            $query->where(function($q) use ($request) {
                foreach ($request->input('location') as $location) {
                    $q->orWhere('kabupaten', 'like', "%{$location}%");
                }
            });
        }

       // Kondisi pencarian berdasarkan industri
        if ($request->input('departments') && !empty($request->input('departments'))) {
            $query->whereHas('departments', function ($query) use ($request) {
                $query->whereIn('name', $request->input('departments'));
            });
        }

        // Kondisi pencarian berdasarkan model bisnis
        if ($request->input('business_model') && !empty($request->input('business_model'))) {
            $query->whereIn('business_model', $request->input('business_model'));
        }

        // Kondisi pencarian berdasarkan funding_stage
        if ($request->input('funding_stage') && !empty($request->input('funding_stage'))) {
            $query->where(function($q) use ($request) {
                foreach ($request->input('funding_stage') as $stage) {
                    $q->orWhere('funding_stage', 'like', "%{$stage}%");
                }
            });
        }

        // Ambil perusahaan dengan data yang diperlukan
        $companies = $query->with('departments')->paginate($rowsPerPage);

        // Tambahkan informasi tambahan ke setiap perusahaan
        foreach ($companies as $company) {
            $company->all_departments = $company->departments->pluck('name');
            $company->departments = $company->departments->take(2)->pluck('name');
            $company->latest_funding_date = $company->fundingRounds->max('announced_date');
        }

        return $companies;
    }

    public function fundingRounds()
    {
        return $this->hasMany(FundingRound::class);
    }
    public function investments()
    {
        return $this->hasMany(Investment::class, 'company_id');
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}
