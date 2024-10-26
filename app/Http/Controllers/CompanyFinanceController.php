<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyFinance;
use Illuminate\Support\Facades\Auth;

class CompanyFinanceController extends Controller
{
    // Menampilkan data CompanyFinance berdasarkan company_id
    public function index(Request $request, $companyId)
    {
        $user = Auth::user();
        // Cek apakah role pengguna adalah "USER"
        $isUserRole = $user->role === 'USER';

        // Menentukan jumlah baris per halaman (default 10)
        $rowsPerPage = $request->get('rows', 10);

        // Mengambil data dengan pagination
        $finances = CompanyFinance::where('company_id', $companyId);

        // Cek apakah ada pencarian
        if ($request['search_finance']) {
            $searchTerm = $request['search_finance'];
            $finances = $finances->where(function ($query) use ($searchTerm) {
                $query->where('tahun', 'like', '%' . $searchTerm . '%')
                    ->orWhere('total_pendapatan', 'like', '%' . $searchTerm . '%')
                    ->orWhere('laba_kotor', 'like', '%' . $searchTerm . '%')
                    ->orWhere('laba_usaha', 'like', '%' . $searchTerm . '%')
                    ->orWhere('laba_sebelum_pajak', 'like', '%' . $searchTerm . '%')
                    ->orWhere('laba_bersih_tahun_berjalan', 'like', '%' . $searchTerm . '%')
                    ->orWhere('status_quarter', 'like', '%' . $searchTerm . '%');
            });
        }

        // Paginate hasil
        $finances = $finances->paginate($rowsPerPage);

        // Tidak perlu melakukan apa-apa jika tidak ada data
        return view('companies.finances.index', compact('finances', 'isUserRole', 'companyId'));
    }

    // Menampilkan form untuk membuat CompanyFinance baru
    public function create($companyId)
    {
        return view('companies.finances.create', compact('companyId'));
    }

    // Menyimpan data CompanyFinance baru
    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'total_pendapatan' => 'required|numeric',
            'laba_kotor' => 'required|numeric',
            'laba_usaha' => 'required|numeric',
            'laba_sebelum_pajak' => 'required|numeric',
            'laba_bersih_tahun_berjalan' => 'required|numeric',
            'status_quarter' => 'required|string',
            'tahun' => 'required|integer',
        ]);

        // Simpan data baru
        CompanyFinance::create($request->all());

        return redirect()->route('company_finances.index', $request->company_id)
            ->with('success', 'Data Company Finance berhasil disimpan.');
    }
}
