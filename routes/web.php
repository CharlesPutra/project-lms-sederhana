<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\GuruTugasController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasUserController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaMateriController;
use App\Http\Controllers\SiswaTugasController;
use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        //ini dashboard admin
        Route::get('/dashboard', fn() => view('Admin.Dashboard'))->name('dashboard');
        //route kelas
        Route::resource('/kelas', KelasController::class);
        //route kelas user atau siswa
        Route::resource('/kelas-user', KelasUserController::class)->only('index', 'create', 'store', 'destroy');
        //route mapel
        Route::resource('/mapel', MapelController::class);
        //ini logout admin
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('Guru.Dashboard'))->name('dashboard');
        //route materi
        Route::resource('/materi', MateriController::class);
        //route tugas
        Route::resource('/tugas', TugasController::class);
        Route::get('tugas/{id}/pengumpulan', [GuruTugasController::class, 'pengumpulan'])
            ->name('tugas.pengumpulan');

        Route::get('pengumpulan/{id}/nilai', [GuruTugasController::class, 'nilai'])
            ->name('pengumpulan.nilai');

        Route::post('pengumpulan/{id}/nilai', [GuruTugasController::class, 'simpanNilai'])
            ->name('pengumpulan.nilai.simpan');
    });

Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        //ini route dashboard siswa
        Route::get('/dashboard', fn() => view('Siswa.Dashboard'))->name('dashboard');
        //route kelas saya
        Route::get('/kelas-saya', [KelasUserController::class, 'kelassaya'])->name('siswa.kelas');
        Route::get('/materi-siswa', [SiswaMateriController::class, 'index'])->name('materi.siswa');
        Route::get('/materi-siswa/{id}', [SiswaMateriController::class, 'show'])->name('materi.siswa.show');
        Route::get('/materi-siswa-dowanload/{id}', [SiswaMateriController::class, 'unduh'])->name('materi.siswa.download');
        //route tugas
        Route::get('tugas', [SiswaTugasController::class, 'index'])->name('tugas.index');
        Route::get('tugas/{id}', [SiswaTugasController::class, 'show'])->name('tugas.show');
        Route::post('tugas/{id}/kumpul', [SiswaTugasController::class, 'kumpul'])->name('tugas.kumpul');
        Route::get('tugas/{id}/download', [SiswaTugasController::class, 'download'])->name('tugas.download');

        //ini logout siswa
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
