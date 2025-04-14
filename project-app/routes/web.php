<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\GeminiAIController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Your custom unauthorized page
Route::get('/unauthorized', function () {
    $title = 'Unauthorized';
    return view('errorpage.401', compact('title'));
});

Route::fallback(function () {
    $title = 'Page Not Found';
    return view('errorpage.404', compact('title'));
});

Route::get('/404', function () {
    $title = 'Page Not Found';
    return view('errorpage.404', compact('title'));
})->name('404');

Route::get('forbidden', function () {
    return view('errorpage.403');
})->name('forbidden');


Route::get('/gemini-ai', function () {
    return view('geminiAI');
});

Route::get('/', [AuthController::class, 'formLogin']);
Route::post('/', [AuthController::class, 'postLogin'])->name('login');


Route::post('/analyze-text', [GeminiAIController::class, 'analyze']);

Route::middleware(['auth:admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(('auth'));
    // route users
    Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('can:role,"admin|ketua_kelas"');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('can:role,"admin|ketua_kelas"');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('can:role,"admin|ketua_kelas"');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('can:role,"admin|ketua_kelas"');
    Route::put('/user/{user}/update', [UserController::class, 'update'])->name('user.update')->middleware('can:role,"admin|ketua_kelas"');
    Route::delete('/user/{user}/destroy', [UserController::class, 'destroy'])->name('user.destroy')->middleware('can:role,"admin|ketua_kelas"');

    // route kelas
    // Route::get('/kelas', [KelasController::class, 'index'])->name('kelas')->middleware(('can:role, "ketua_kelas"'));
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas')->middleware(('auth'));

    // route siswa
    // Route::get('/', [SiswaController::class, 'index'])->name('siswa')->middleware(('can:role, "siswa" '));
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa')->middleware(('auth'));
    Route::get('/profile', [SiswaController::class, 'profile'])->name('profile')->middleware(('can:role,"siswa"'));
    Route::get('/profile/siswa', [SiswaController::class, 'create'])->name('siswa.create')->middleware('can:role,"siswa"');
    Route::post('/profile/siswa/store', [SiswaController::class, 'store'])->name('siswa.store')->middleware('can:role,"siswa"');

    // route bendahara
    // Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran')->middleware(('can:role, "bendahara"'));
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran')->middleware(('auth'));
    Route::get('/pembayaran/create', [PembayaranController::class, 'create'])->name('pembayaran.create')->middleware('can:role,"admin|bendahara"');
    Route::post('/pembayaran/store', [PembayaranController::class, 'store'])->name('pembayaran.store')->middleware('can:role,"admin|bendahara"');
    Route::delete('/pembayaran/{pembayaran}/destroy', [PembayaranController::class, 'destroy'])->name('pembayaran.destroy')->middleware('can:role,"admin|bendahara"');
    // Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi')->middleware(('can:role, "bendahara"'));
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi')->middleware(('auth'));
});
