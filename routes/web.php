<?php

use Illuminate\Support\Facades\Route;

// AUTH CONTROLLERS
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// APP CONTROLLERS
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\UserAnggotaController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\QuranController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AsmaulHusnaController;
use App\Http\Controllers\DzikirController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ManagementAdminController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MateriController;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| USER LOGIN & REGISTER
|--------------------------------------------------------------------------
*/
Route::prefix('user')->group(function () {

    // LOGIN USER (ANGGOTA)
    Route::get('/login', [LoginUserController::class, 'showLoginForm'])->name('login.user');
    Route::post('/login', [LoginUserController::class, 'authenticate'])
    ->middleware('throttle:5,1')
    ->name('login.user.post');

    // REGISTER USER
    Route::get('/register', [RegisterUserController::class, 'showRegisterForm'])->name('register.user');
    Route::post('/register', [RegisterUserController::class, 'register'])->name('register.user.store');

    // ROUTE LUPA PASSWORD (SISTEM OTP KODE EMAIL)
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendOtp'])->name('password.email');
    
    // ROUTE VERIFIKASI KODE OTP
    Route::get('/verify-otp', [ResetPasswordController::class, 'showOtpForm'])->name('password.otp');
    Route::post('/verify-otp', [ResetPasswordController::class, 'verifyOtp'])->name('password.verify');

    // ROUTE BUAT PASSWORD BARU
    Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('/profile', [UserAnggotaController::class, 'editProfile'])->name('user.profile.edit');
    Route::put('/profile', [UserAnggotaController::class, 'updateProfile'])->name('user.profile.update');

    /*
    |--------------------------------------------------------------------------
    | USER AREA (HARUS LOGIN)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:anggota')->group(function () {
        Route::get('/home', [LandingPageController::class, 'index'])->name('user.home');
        
        // BLOG FRONTEND
        Route::get('/blogs', [BlogsController::class, 'frontendIndex'])->name('user.blogs.index');
        Route::get('/blogs/{slug}', [BlogsController::class, 'frontendDetail'])->name('user.blogs.detail');
        
        // INVENTARIS USER (READ ONLY)
        Route::get('/inventaris', [InventarisController::class, 'userIndex'])->name('user.inventaris');
        Route::get('/inventaris/{id}', [InventarisController::class, 'userShow'])->name('user.inventaris.detail');

        // STATIC PAGES USER
        Route::view('/about', 'pages.about')->name('user.about');
        Route::view('/struktur', 'setting.users')->name('user.struktur');
        Route::view('/kegiatan', 'pages.about.home')->name('user.kegiatan');
        Route::view('/pendaftaran', 'user.Panduan')->name('user.pendaftaran');

        // LOGOUT (anggota / user)
        Route::post('/logout', function () {
            if (auth()->guard('web')->check()) {
                auth()->guard('web')->logout();
            }
            if (auth()->guard('anggota')->check()) {
                auth()->guard('anggota')->logout();
            }
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect('/');
        })->name('logout.user');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    // LOGIN ADMIN
    Route::get('/login', [LoginAdminController::class, 'showLoginForm'])->name('login.admin');
    Route::post('/login', [LoginAdminController::class, 'login'])->name('login.admin.submit');

    // LOGOUT ADMIN
    Route::post('/logout', [LoginAdminController::class, 'logout'])->name('logout.admin');

    /*
    |--------------------------------------------------------------------------
    | ADMIN PROTECTED ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // ==========================================
        // ROUTES EXPORT PDF (Harus diatas Route::resource)
        // ==========================================
        Route::get('/anggota/export-pdf', [UserAnggotaController::class, 'exportPdf'])->name('admin.anggota.pdf');
        Route::get('/documents/export-pdf', [DocumentController::class, 'exportPdf'])->name('admin.documents.pdf');
        Route::get('/keuangan/export-pdf', [KeuanganController::class, 'exportPdf'])->name('admin.keuangan.pdf');
        Route::get('/inventaris/export-pdf', [InventarisController::class, 'exportPdf'])->name('admin.inventaris.pdf');
        Route::get('/blogs/export-pdf', [BlogsController::class, 'exportPdf'])->name('admin.blogs.pdf');
        Route::get('/materi/export-pdf', [MateriController::class, 'exportPdf'])->name('admin.materi.pdf');
        // ==========================================

        // DOCUMENT CRUD
        Route::resource('documents', DocumentController::class)
            ->names(['index' => 'admin.documents.index', 'store' => 'admin.documents.store', 'update' => 'admin.documents.update', 'destroy' => 'admin.documents.destroy'])
            ->only(['index', 'store', 'update', 'destroy']);

        Route::resource('keuangan', KeuanganController::class)
            ->names(['index' => 'admin.keuangan.index', 'store' => 'admin.keuangan.store', 'update' => 'admin.keuangan.update', 'destroy' => 'admin.keuangan.destroy'])
            ->only(['index', 'store', 'update', 'destroy']);

        Route::get('/manage', [ManagementAdminController::class, 'index'])->name('admin.manage.index');
        Route::post('/manage/store', [ManagementAdminController::class, 'store'])->name('admin.manage.store');
        Route::put('/manage/password', [ManagementAdminController::class, 'updatePassword'])->name('admin.password.update');
        Route::delete('/manage/{id}', [ManagementAdminController::class, 'destroy'])->name('admin.manage.destroy');

        // CRUD Anggota
        Route::resource('/anggota', UserAnggotaController::class)->names('admin.anggota')->only(['index', 'store', 'update', 'destroy']);

        // BLOG CRUD
        Route::get('/blogs', [BlogsController::class, 'index'])->name('admin.blogs.index');
        Route::post('/blogs', [BlogsController::class, 'store'])->name('admin.blogs.store');
        Route::get('/blogs/{id}', [BlogsController::class, 'edit'])->name('admin.blogs.edit');
        Route::put('/blogs/{id}', [BlogsController::class, 'update'])->name('admin.blogs.update');
        Route::delete('/blogs/{id}', [BlogsController::class, 'destroy'])->name('admin.blogs.destroy');
        Route::delete('/comments/{id}', [BlogsController::class, 'destroyComment'])->name('admin.comments.destroy');

        // INVENTARIS CRUD
        Route::get('/inventaris', [InventarisController::class, 'index'])->name('admin.inventaris.index');
        Route::post('/inventaris', [InventarisController::class, 'store'])->name('admin.inventaris.store');
        Route::put('/inventaris/{id}', [InventarisController::class, 'update'])->name('admin.inventaris.update');
        Route::delete('/inventaris/{id}', [InventarisController::class, 'destroy'])->name('admin.inventaris.destroy');
        Route::get('/inventaris/{id}/download', [InventarisController::class, 'downloadPDF'])->name('admin.inventaris.download'); // Download SOP
        
        Route::get('/pesan', [PesanController::class, 'index'])->name('admin.pesan.index');
        Route::delete('/pesan/{id}', [PesanController::class, 'destroy'])->name('admin.pesan.destroy');
        Route::patch('/pesan/{id}/read', [PesanController::class, 'markAsRead'])->name('admin.pesan.read');

        // ROUTE KABINET & BIDANG
        Route::resource('/cabinets', CabinetController::class)->names('admin.cabinets')->only(['index', 'store', 'show', 'update', 'destroy']);
        Route::resource('/departments', DepartmentController::class)->names('admin.departments')->only(['store', 'update', 'destroy']);

        // MATERI CRUD
        Route::resource('materi', MateriController::class)->names('admin.materi');
    });
});

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::view('/about', 'pages.about')->name('about');
Route::get('/about/struktur/{id?}', [LandingPageController::class, 'struktur'])->name('struktur');
Route::view('/about/kegiatan', 'pages.about.kegiatan')->name('kegiatan');
Route::view('/about/mediasosial', 'pages.about.pendaftaran')->name('mediasosial');

Route::get('/kontak', function () { return view('pages.kontak'); })->name('kontak');

Route::get('/blogs', [BlogsController::class, 'frontendIndex'])->name('blogs.index');
Route::get('/blogs/{slug}', [BlogsController::class, 'frontendDetail'])->name('blogs.detail');
Route::post('/blogs/{id}/comment', [BlogsController::class, 'storeComment'])->name('blogs.comment.store');
Route::post('/contact-send', [PesanController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| FITUR BACAAN
|--------------------------------------------------------------------------
*/
Route::prefix('bacaan')->group(function () {
    Route::get('/', function (\Illuminate\Http\Request $request) {
        $query = \App\Models\Materi::query();
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }
        $materis = $query->latest()->paginate(9)->withQueryString();
        return view('pages.bacaan.index', compact('materis'));
    })->name('bacaan.index');

    Route::prefix('quran')->group(function () {
        Route::get('/', [QuranController::class, 'index'])->name('quran.index');
        Route::get('/{nomor}', [QuranController::class, 'show'])->name('quran.show');
    });

    Route::get('/asmaul-husna', [AsmaulHusnaController::class, 'asmaulHusna'])->name('asmaul.index');
    Route::get('/almatsurat/{waktu?}', [DzikirController::class, 'index'])->name('almatsurat.index');
});