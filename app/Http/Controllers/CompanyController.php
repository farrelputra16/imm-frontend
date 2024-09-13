<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    /**
     * Update the specified Company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan melalui formulir
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'profile' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'nama_pic' => 'required|string|max:255',
            'posisi_pic' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'jumlah_karyawan' => 'required|integer',
        ]);

        // Temukan Company berdasarkan ID
        $company = Company::findOrFail($id);

        // Update data perusahaan
        $company->update($validated);

        // Redirect ke halaman profil perusahaan dengan pesan sukses
        return redirect()->route('profile-commpany.show', $company->id)->with('success', 'Data perusahaan berhasil diperbarui.');
    }
    
    public function store(Request $request)
    {
        // Validasi data yang dikirimkan melalui formulir
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'profile' => 'required|string|max:255',
            'tipe' => 'required|string|max:255',
            'nama_pic' => 'required|string|max:255',
            'posisi_pic' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'jumlah_karyawan' => 'required|integer',
        ]);

        // Simpan data ke dalam database
        Company::create([
            'user_id' => Auth::id(),
            'nama' => $validated['nama'],
            'profile' => $validated['profile'],
            'tipe' => $validated['tipe'],
            'nama_pic' => $validated['nama_pic'],
            'posisi_pic' => $validated['posisi_pic'],
            'telepon' => $validated['telepon'],
            'negara' => $validated['negara'],
            'provinsi' => $validated['provinsi'],
            'kabupaten' => $validated['kabupaten'],
            'jumlah_karyawan' => $validated['jumlah_karyawan'],
        ]);

        // Redirect ke homepage
        return redirect()->route('homepage')->with('success', 'Company created successfully.');
    }

    /**
     * Display the specified Company.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }public function index()
    {
        $user = Auth::user();
        $companies = Company::where('user_id', $user->id)->get();
        return view('homepageimm.homepage', compact('companies'));
    }
    /**
     * Show the form for editing the specified Company.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    /**
     * Remove the specified Company from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully.');
    }
}
