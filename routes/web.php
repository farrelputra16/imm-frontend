<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HubsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\CompanyIncomeController;
use App\Http\Controllers\MetricProjectController;
use App\Http\Controllers\CompanyOutcomeController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ManagementKeuanganController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FundingRoundController;
use App\Http\Controllers\InvestorPageController;
// Rute untuk autentikasi
Auth::routes();
Auth::routes(['verify' => true]);

// Rute yang bisa diakses tanpa login (Login dan Register)
Route::get('/choose-role', function () {
    return view('auth.choose-role');
})->name('auth.choose-role');
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');
Route::get('/investors', [InvestorController::class, 'index'])->name('investors.index');
Route::get('/investors/{id}', [InvestorController::class, 'show'])
    ->name('investors.show')
    ->middleware('checkrole:USER');


Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
Route::get('/people/{id}', [PeopleController::class, 'show'])->name('people.show');

Route::middleware(['auth'])->group(function () {
    // Route untuk menampilkan form pengajuan hub
    Route::get('/hubs/create', [HubsController::class, 'create'])->name('hubs.create');
    Route::post('/hubs/store', [HubsController::class, 'store'])->name('hubs.store');

    // Route untuk menampilkan daftar pengajuan pengguna
    Route::get('/hubs/hubsubmission', [HubsController::class, 'mySubmissions'])->name('hubs.create.hubsubmission');
});

// Route umum yang tidak memerlukan autentikasi
Route::get('/hubs', [HubsController::class, 'index'])->name('hubs.index');
Route::get('/hubs/{id}', [HubsController::class, 'show'])->name('hubs.show');


// Rute index untuk menampilkan funding rounds tanpa middleware auth


Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth', 'user');

Route::get('/survey-tangapan', function () {
    return view('survey.edit-survey.survey-tangapan');
})->name('survey-tangapan');
Route::get('/survey-tangapan-chart', function () {
    return view('survey.edit-survey.survey-tangapan-chart');
})->name('survey-tangapan-chart');
Route::get('/survey-tangapan-diagram', function () {
    return view('survey.edit-survey.survey-tangapan-diagram');
})->name('survey-tangapan-diagram');

Route::get('event', [EventController::class, 'index'])->name('events.index');
Route::get('/events/make/{user_id}', [EventController::class, 'create'])->name('events.make');
Route::post('event', [EventController::class, 'store'])->name('events.store');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');


Route::get('event/{id}', [EventController::class, 'view'])->name('events.view');



Route::get('responden/{id}', [SurveyController::class, 'view'])->name('surveys.view');
Route::get('responden-data-diri/{id}', [SurveyController::class, 'dataDiri'])->name('surveys.data-diri');
Route::post('responden/{id}', [SurveyController::class, 'registerUser'])->name('surveys.register-user');
Route::post('responden/{survey}/{user}/submit', [SurveyController::class, 'submit'])->name('surveys.submit');

// routes/web.php

// Menampilkan formulir untuk mengirim email reset password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Mengirim email reset password
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Menampilkan formulir reset password
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Mengatur ulang password
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

/**
 * Pembuatan Route untuk bagian view list company pada
 *  bagian tampilan table company yang tidak memerlukan autentikasi
 * */
Route::get('/companies-list', [CompanyController::class, 'companyList'])->name('companies.list');
Route::get('/companies/{id}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/companies/{id}/team', [CompanyController::class, 'showTeam'])->name('companies.team');
Route::get('/companies/{id}/project', [CompanyController::class, 'showProducts'])->name('companies.project');

/**
 * Pembuatan Route untuk bagian melihat project pada company yang tidak memerlukan autentikasi
 * */
Route::get('companies/projects/{id}', [ProjectController::class, 'show'])->name('companies-project.show');
Route::get('companies/project/{projectId}/metric/{metricId}/metricProject/{metricProjectId}/impact', [MetricProjectController::class, 'showImpact'])->name('companies-metric-impact.show');

/**
 *  Berikut ini merupakan rute untuk menangani wishlist dari investor
 */
Route::post('/wishlist/add', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');

// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/myproject', [ProjectController::class, 'index'])->name('myproject.myproject');
    Route::get('/imm', function () {
        return view('imm.imm');
    })->name('imm')->middleware('check.company');

    Route::get('/detail-biaya/{project_id}', [CompanyOutcomeController::class, 'detailOutcome'])->name('homepageimm.detailbiaya');

    // Routes untuk Manajemen Keuangan
    Route::prefix('kelolapengeluaran')->group(function () {
        Route::get('/', [ManagementKeuanganController::class, 'show'])->name('kelolapengeluaran');
    });

    // Rute untuk pencarian pengeluaran yang juga mengarah ke metode show
    Route::get('/kelola-pengeluaran/search-expense', [ManagementKeuanganController::class, 'show'])->name('searchExpense');

    // Routes untuk Dana Masuk (Company Income)
    Route::prefix('dana-masuk')->group(function () {
        Route::get('/tambah', [CompanyIncomeController::class, 'show'])->name('createCompanyIncome');
        Route::post('/', [CompanyIncomeController::class, 'store'])->name('companyIncome.store');
    });

    // Routes untuk Pengeluaran Proyek (Company Outcome)
    Route::prefix('pengeluaran-proyek')->group(function () {
        Route::get('/tambah', [ManagementKeuanganController::class, 'createOutcome'])->name('selectProjectOutcome');
        Route::post('/company-outcome', [CompanyOutcomeController::class, 'store'])->name('companyOutcome.store');
    });

    Route::group(['middleware' => ['auth', 'investor']], function () {
        Route::get(
            '/investor-home',
            [InvestorPageController::class, 'index'] // Return the view for investor homepage
        )->name('investor.home');
        Route::get('/companies/{companyId}/start-invest', [FundingRoundController::class, 'startInvest'])->name('start.invest');
    });

    Route::group(['middleware' => ['auth', 'people']], function () {
        Route::get('/people-home', function () {
            return view('peoplepage.home'); // Return the view for investor homepage
        })->name('people.home');
        Route::get('/people-profile', [PeopleController::class, 'profile'])->name('people.profile');
        Route::put('/people-profile/update', [PeopleController::class, 'updateProfile'])->name('people.updateProfile');
    });
    Route::middleware(['auth'])->group(function () {
        // Menampilkan daftar funding rounds yang dimiliki oleh perusahaan yang login
        Route::get('/company/funding-rounds', [FundingRoundController::class, 'companyList'])->name('company.funding_rounds.list');

        // Menampilkan halaman detail dan edit untuk funding round perusahaan
        Route::get('/company/funding-rounds/{fundingRound}/detail', [FundingRoundController::class, 'companyDetail'])->name('company.funding_rounds.detail');

        // Menyimpan perubahan pada funding round perusahaan
        Route::put('/company/funding-rounds/{fundingRound}/update', [FundingRoundController::class, 'companyUpdate'])->name('company.funding_rounds.update');

        // Form untuk membuat funding round baru untuk perusahaan
        Route::get('/company/funding-rounds/create', [FundingRoundController::class, 'companyCreate'])->name('company.funding_rounds.create');

        // Menyimpan funding round baru yang diajukan perusahaan
        Route::post('/company/funding-rounds', [FundingRoundController::class, 'companyStore'])->name('company.funding_rounds.store');
    });
    // routes/web.php
    // Routing untuk Funding Rounds dan Investments
    Route::get('/funding-rounds', [FundingRoundController::class, 'index'])->name('funding_rounds.index');
    Route::get('/funding-rounds/{fundingRound}', [FundingRoundController::class, 'show'])->name('funding_rounds.show');
    Route::middleware(['auth'])->group(function () {
        // Routing untuk Investments berdasarkan Funding Round
        Route::get('funding-rounds/{fundingRound}/invest', [InvestmentController::class, 'createFromFundingRound'])->name('investments.createFromFundingRound');
        Route::post('funding-rounds/{fundingRound}/invest', [InvestmentController::class, 'storeFromFundingRound'])->name('investments.storeFromFundingRound');

        // Route untuk investor melihat pending investments
        Route::get('investments/pending', [InvestmentController::class, 'pending'])->name('investments.pending');

        // Route untuk approve oleh pemilik perusahaan
        Route::post('investments/{investment}/approve', [InvestmentController::class, 'approve'])->name('investments.approve');

        // Route untuk halaman approval untuk user (pemilik company)
        Route::get('investments/approval', [InvestmentController::class, 'approval'])->name('investments.approvals');

        // Route untuk update status investasi (approve/reject)
        Route::post('investments/{investment}/status', [InvestmentController::class, 'updateStatus'])->name('investments.updateStatus');
    });


    Route::get('/hubungi-sekarang/{event_id}', [EventController::class, 'hubungiSekarang'])->name('hubungi.sekarang');

    Route::get('/blog', function () {
        return view('blog.blog');
    });

    Route::get('/kodeotp', function () {
        return view('imm.kodeotp');
    });

    Route::get('/pendaftaranperusahaan', [CompanyController::class, 'create_company'])->name('companies.create');


    Route::get('/myproject', function () {
        return view('myproject.myproject');
    });

    Route::get('/blogarticle', function () {
        return view('blog.blogarticle');
    });

    Route::get('/laporanproject', function () {
        return view('homepageimm.laporanproject');
    });

    Route::get('/reportbulanpertama', function () {
        return view('homepageimm.reportbulanpertama');
    });

    Route::get('/detail', function () {
        return view('myproject.detail');
    });

    Route::get('/impact', function () {
        return view('myproject.impact');
    })->name('impact.impact');


    // Rute untuk menampilkan form kosong untuk menambahkan laporan baru
    Route::get('/metric-projects/{projectId}/matrixreport/create/{metricId}/{metricProjectId}', [MetricProjectController::class, 'createMatrixReport'])->name('metric-projects.createMatrixReport');
    Route::post('/metric-projects/{projectId}/matrixreport', [MetricProjectController::class, 'storeMatrixReport'])->name('metric-projects.storeMatrixReport');

    Route::get('/metric-projects/{projectId}/matrixreport/{metricId}/{reportId}/{metricProjectId}', [MetricProjectController::class, 'showReport'])->name('metric-projects.showReport');
    Route::get('/projects/{id}', [ProjectController::class, 'view'])->name('myproject.detail');

    Route::get('/project/{projectId}/metric/{metricId}/metricProject/{metricProjectId}/impact', [MetricProjectController::class, 'showMetricImpact'])->name('metric-impact.show');
    // Rute untuk menampilkan laporan yang sudah ada

    // Rute untuk menampilkan halaman matrixreport (menampilkan laporan yang sudah ada)
    Route::get('/metric-projects/{id}/matrixreport', [MetricProjectController::class, 'matrixReport'])->name('metric-projects.matrixreport');

    // Rute untuk memperbarui laporan yang sudah ada
    Route::put('/metric-projects/{projectId}/matrixreport/{reportId}', [MetricProjectController::class, 'updateMatrixReport'])->name('metric-projects.updateMatrixReport');

    // Rute untuk menampilkan halaman impact setelah menambah atau memperbarui laporan
    Route::get('metric-projects/{projectId}/impact', [MetricProjectController::class, 'impact'])->name('metric-projects.impact');

    Route::get('/matrixreport', function () {
        return view('myproject.creatproject.matrixreport');
    });

    Route::get('/review', function () {
        return view('myproject.creatproject.review');
    });

    Route::get('/pemilihansdgs', function () {
        return view('myproject.creatproject.pemilihansdgs');
    });

    Route::get('/indicator', function () {
        return view('myproject.creatproject.indicator');
    });

    Route::get('/metrix', function () {
        return view('myproject.creatproject.metrix');
    });

    Route::get('/detailreview', function () {
        return view('myproject.creatproject.detailreview');
    });



    Route::get('/bootcamp', function () {
        return view('bootcamp.bootcamp');
    });

    Route::get('/succes', function () {
        return view('event.succes');
    });



    Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
    Route::get('/blogarticle/{id}/view', [PostController::class, 'view'])->name('blog.view');

    Route::get('/imm3', [VerificationController::class, 'showVerificationForm'])->name('imm3');
    Route::get('/kodeotp', [VerificationController::class, 'showOtpVerification'])->name('kodeotp');
    Route::post('/send-otp', [VerificationController::class, 'sendVerificationEmail'])->name('send-otp');
    Route::post('/verify-code', [VerificationController::class, 'verifyCode'])->name('verify-code');

    Route::resource('projects', ProjectController::class);
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/creatproject', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::post('/projects/filter-metrics', [ProjectController::class, 'filterMetrics'])->name('projects.filterMetrics');
    Route::get('/myproject', [ProjectController::class, 'index'])->name('myproject.myproject');
    Route::get('/detail/{id}', [ProjectController::class, 'view'])->name('projects.view');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::post('projects/{project}/complete', [ProjectController::class, 'complete'])->name('projects.complete');

    Route::get('/companies', [CompanyController::class, 'index']);
    Route::resource('companies', 'CompanyController');
    Route::post('/homepage', [CompanyController::class, 'store'])->name('companies.store');

    Route::get('event-register/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::put('event/{id}', [EventController::class, 'update'])->name('events.update');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile')->middleware('auth');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile-company', [ProfileController::class, 'editCompanyProfile'])->name('profile-company');
    Route::put('/profile-company/{id}', [ProfileController::class, 'updateCompanyProfile'])->name('profile-company.update');
    Route::get('/profile-company', [ProfileController::class, 'editCompanyProfile'])
        ->name('profile-company')
        ->middleware('check.company');
    Route::get('/profile-company', [ProfileController::class, 'editCompanyProfile'])->name('profile-company')->middleware('check.company');

    // routes untuk anggota team dari company
    Route::get('/search-people', [TeamController::class, 'searchPeople']);
    Route::post('/team/store', [TeamController::class, 'store']);
    Route::get('/team/{id}/edit', [TeamController::class, 'editTeam'])->name('team.edit');
    Route::put('/team/{id}', [TeamController::class, 'updateTeam'])->name('team.update');
    Route::delete('/team/{id}/{companies_id}/delete', [TeamController::class, 'destroyTeam']);

    /*
        Berikut ini merupakan rute untuk project dari company
    */
    // Menambahkan produk baru untuk perusahaan tertentu
    Route::post('/companies/{companyId}/projects', [ProductController::class, 'store']);
    // Mengedit produk untuk perusahaan tertentu
    Route::post('/companies/{companyId}/projects/{id}', [ProductController::class, 'update']);
    // Menghapus produk untuk perusahaan tertentu
    Route::delete('/companies/projects/delete/{id}', [ProductController::class, 'destroy']);
});

Route::get('/verifikasidiri', function () {
    return view('imm.verifikasidiri');
})->name('verifikasi-diri');

Route::get('/blog', function () {
    return view('blog.blog');
});

Route::get('/kodeotp', function () {
    return view('imm.kodeotp');
});

// Route::get('/pendaftaranperusahaan', function () {
//     return view('imm.pendaftaranperusahaan');
// });

Route::get('/detail-kelas', function () {
    return view('kelas.detail-kelas');
});



Route::get('/blogarticle', function () {
    return view('blog.blogarticle');
});

Route::get('/laporanproject', function () {
    return view('homepageimm.laporanproject');
});

Route::get('/reportbulanpertama', function () {
    return view('homepageimm.reportbulanpertama');
});

Route::get('/detail', function () {
    return view('myproject.detail');
});

Route::get('/impact', function () {
    return view('myproject.impact');
});

Route::get('/matrixreport', function () {
    return view('myproject.creatproject.matrixreport');
});

Route::get('/review', function () {
    return view('myproject.creatproject.review');
});


Route::get('/pemilihansdgs', function () {
    return view('myproject.creatproject.pemilihansdgs');
});

Route::get('/indicator', function () {
    return view('myproject.creatproject.indicator');
});

Route::get('/metrix', function () {
    return view('myproject.creatproject.metrix');
});

Route::get('/detailreview', function () {
    return view('myproject.creatproject.detailreview');
});

Route::get('/responden', function () {
    return view('survey.responden.responden');
});

Route::get('/responden-data-diri', function () {
    return view('survey.responden.responden-data-diri');
});

Route::get('/responden-esay', function () {
    return view('survey.responden.responden-esay');
});

// Route::get('/kelolapengeluaran', function () {
//     return view('homepageimm.kelolapengeluaran');
// });

Route::get('/detailbiaya', function () {
    return view('homepageimm.detailbiaya');
});

Route::get('/unggahdokumen', function () {
    return view('myproject.creatproject.unggahdokumen');
});

Route::get('/tambahpenggunaandana', function () {
    return view('homepageimm.tambahpenggunaandana');
});

Route::get('/responden-pilihan-ganda', function () {
    return view('survey.responden.responden-pilihan-ganda');
});

Route::get('/responden-skala', function () {
    return view('survey.responden.responden-skala');
});

Route::get('/responden-penutup-survey', function () {
    return view('survey.responden.responden-penutup-survey');
});

Route::get('/event-detail/{id}', [EventController::class, 'view'])->name('events.view');

Route::get('/detail-kelas', function () {
    return view('kelas.detail-kelas');
});

Route::get('/bootcamp', function () {
    return view('bootcamp.bootcamp');
});

Route::get('/event-register', [EventController::class, 'create'])->name('events.create');

Route::get('/succes', function () {
    return view('event.succes');
});

Route::get('/kuesioner', function () {
    return view('survey.responden.kuesioner');
});

Route::get('/responden/{id}', 'SurveyController@view')->name('survey.responden.view');


// Route::get('/homepage', function () {
//     $user = auth()->user();
//     $company = $user->company;

//     return view('homepageimm.homepage', compact('company', 'user'));
// })->name('homepage')->middleware('check.company');

Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage')->middleware('check.company');

Route::get('metric-projects/{id}', [MetricProjectController::class, 'index'])->name('metric-projects.index');
Route::prefix('projects/{project}')->group(function () {
    Route::get('metric-projects/{metricProject}/add-report', [MetricProjectController::class, 'addReport'])->name('metric-projects.addReport');
    Route::post('metric-projects', [MetricProjectController::class, 'store'])->name('metric-projects.store');
    Route::post('metric-projects/{metricProject}/store-report', [MetricProjectController::class, 'storeReport'])->name('metric-projects.storeReport');
});

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::get('/blogarticle/{id}/view', [PostController::class, 'view'])->name('blog.view');

Route::get('/imm3', [VerificationController::class, 'showVerificationForm'])->name('imm3');
Route::post('/send-otp', [VerificationController::class, 'sendVerificationEmail'])->name('send-otp');
Route::post('/verify-code', [VerificationController::class, 'verifyCode'])->name('verify-code');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/creatproject', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

Route::get('/projects/filter-metrics', [ProjectController::class, 'filterMetrics'])->name('projects.filterMetrics');

Route::get('/verifikasi-diri', function () {
    return view('imm.imm');
})->name('verifikasidiri');

Route::get('/berhasilverif', function () {
    return view('imm.berhasilverif');
})->name('berhasilverif');

Route::get('responden/{id}', [SurveyController::class, 'view'])->name('surveys.view');
Route::get('responden-data-diri/{id}', [SurveyController::class, 'dataDiri'])->name('surveys.data-diri');
Route::post('responden/{id}', [SurveyController::class, 'registerUser'])->name('surveys.register-user');
Route::post('responden/{survey}/{user}/submit', [SurveyController::class, 'submit'])->name('surveys.submit');
Route::get('create-survey/{id}', [SurveyController::class, 'create'])->name('surveys.create');
Route::post('survey', [SurveyController::class, 'store'])->name('surveys.store');
Route::get('/responden/{id}', [SurveyController::class, 'view'])->name('surveys.view');
Route::get('edit-survey/{survey}', [SurveyController::class, 'edit'])->name('surveys.edit');
Route::put('surveys/{survey}', [SurveyController::class, 'update'])->name('surveys.update');
Route::delete('survey/{survey}', [SurveyController::class, 'destroy'])->name('surveys.destroy');
Route::get('survey-result/{survey}', [SurveyController::class, 'results'])->name('surveys.results');

Route::get('/about', [HomeController::class, 'about']);
