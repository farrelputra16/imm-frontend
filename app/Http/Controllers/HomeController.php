<?php
// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $company = $user->companies;
        $projects = $company ? $company->projects : collect();

        return view('home', compact('projects'));

      
        // Cek apakah user memiliki company
        if ($user->company) {
            $company = $user->company;
            return view('homepageimm.homepage', compact('user', 'company'));
        } else {
            // Jika user tidak memiliki company, tindakan selanjutnya sesuai kebutuhan aplikasi Anda
            return redirect()->route('buat-company'); // Contoh pengalihan ke halaman membuat company baru
        }
    }

    public function about()
    {
        return view('about');
    }


}

