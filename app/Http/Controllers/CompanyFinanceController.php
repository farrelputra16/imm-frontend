<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;
use App\Models\CompanyFinance;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectFinancialUpdated;

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
        $validatedData = $request->validate([
            'company_id' => 'required|exists:companies,id',
            'total_pendapatan' => 'required|numeric',
            'laba_kotor' => 'required|numeric',
            'laba_usaha' => 'required|numeric',
            'laba_sebelum_pajak' => 'required|numeric',
            'laba_bersih_tahun_berjalan' => 'required|numeric',
            'status_quarter' => 'required|string',
            'tahun' => 'required|string',
        ]);

        // Simpan data baru
        $finance = CompanyFinance::create($validatedData);

        // Ambil semua investor yang berinvestasi di perusahaan ini
        $investments = Investment::where('company_id', $validatedData['company_id'])->get();

        foreach ($investments as $investment) {
            $investor = $investment->investor;
            $user = $investor->user;
            $email = $user->email;
            $investorName = $user->nama_depan; // Ambil nama investor
            $investorName .= $user->nama_belakang ? ' ' . $user->nama_belakang : ''; // Tambahkan nama belakang jika ada

            try {
                // Kirim email ke investor
                Mail::to($email)->send(new ProjectFinancialUpdated($finance, $investorName));
            } catch (\Exception $e) {
                // Log error jika email gagal dikirim
                Log::error("Email gagal dikirim ke {$email}: " . $e->getMessage());
            }
        }

        return redirect()->route('company_finances.index', $validatedData['company_id'])
            ->with('success', 'Data Company Finance berhasil disimpan dan email telah dikirim kepada semua investor.');
    }
}
