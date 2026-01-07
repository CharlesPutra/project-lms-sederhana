<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasUserController;
use App\Http\Controllers\ProfileController;
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
        Route::resource('/kelas-user',KelasUserController::class)->only('index','create','store','destroy');
        //ini logout admin
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('Guru.Dashboard'))->name('dashboard');
    });

Route::middleware(['auth', 'role:siswa'])
    ->prefix('siswa')
    ->name('siswa.')
    ->group(function () {
        //ini route dashboard siswa
        Route::get('/dashboard', fn() => view('Siswa.Dashboard'))->name('dashboard');
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
