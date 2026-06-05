<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     if (!Auth::check()) {
//         return redirect('login');
//     } else {
//         return redirect('panel');
//     }
// });

// Workaround for Windows `php artisan serve` symlink 403 Forbidden issue
Route::get('berkas/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/public/' . $folder . '/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home');
    Route::get('tentang', 'tentang');
    Route::get('visimisi', 'visimisi');
    Route::get('struktur', 'struktur');
    Route::get('kontak', 'kontak');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login');
    Route::post('loginproses', 'loginproses');
    Route::get('register', 'register');
    Route::post('registerproses', 'registerproses');
    Route::get('logout', 'logout')->name('logout');
});

Route::controller(PasswordResetController::class)->group(function () {
    Route::get('forgot-password', 'showForgotForm')->name('password.request');
    Route::post('forgot-password', 'sendResetLink')->name('password.email');
    Route::get('reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('reset-password', 'resetPassword')->name('password.update');
});

Route::middleware(['auth'])->controller(PanelController::class)->group(function () {
    Route::get('panel', 'dashboard');

    // warga
    Route::get('panel/warga', 'warga');
    Route::post('panel/wargasimpan', 'wargasimpan');
    Route::get('panel/wargaedit/{id}', 'wargaedit');
    Route::put('panel/wargaupdate/{id}', 'wargaupdate');
    Route::delete('panel/wargahapus/{id}', 'wargahapus');

    // arsip
    Route::get('panel/arsip', 'arsip');
    Route::post('panel/arsipsimpan', 'arsipsimpan');
    Route::get('panel/arsipedit/{id}', 'arsipedit');
    Route::put('panel/arsipupdate/{id}', 'arsipupdate');
    Route::delete('panel/arsiphapus/{id}', 'arsiphapus');

    // staff
    Route::get('panel/staff', 'staff');
    Route::post('panel/staffsimpan', 'staffsimpan');
    Route::get('panel/staffedit/{id}', 'staffedit');
    Route::put('panel/staffupdate/{id}', 'staffupdate');
    Route::delete('panel/staffhapus/{id}', 'staffhapus');

    // riwayatpengajuan
    Route::get('panel/riwayatpengajuan', 'riwayatpengajuan');
    
    // notifikasi
    Route::get('panel/ceknotifikasi', 'cekNotifikasi');

    // suratmasuk
    Route::get('panel/suratmasuk', 'suratmasuk');
    Route::get('panel/suratmasuktambah', 'suratmasuktambah');
    Route::post('panel/suratmasuksimpan', 'suratmasuksimpan');
    Route::get('panel/suratmasukdetail/{id}', 'suratmasukdetail');
    Route::put('panel/suratupdatestatus/{id}', 'suratupdatestatus');
    Route::get('panel/suratmasukedit/{id}', 'suratmasukedit');
    Route::put('panel/suratmasukupdate/{id}', 'suratmasukupdate');
    Route::delete('panel/suratmasukhapus/{id}', 'suratmasukhapus');

    // suratkeluar
    Route::get('panel/suratkeluar', 'suratkeluar');
    Route::get('panel/suratkeluardetail/{id}', 'suratkeluardetail');
    Route::put('panel/suratupdatestatus/{id}', 'suratupdatestatus');
    Route::delete('panel/suratkeluarhapus/{id}', 'suratkeluarhapus');
    Route::get('panel/sktmcetak/{id}', 'sktmcetak');
    Route::get('panel/skucetak/{id}', 'skucetak');
    Route::get('panel/rekomendasicetak/{id}', 'rekomendasicetak');

    Route::get('panel/nikahcetak/{id}', 'nikahcetak');

    // setting
    Route::get('panel/setting', 'setting');
    Route::put('panel/settingupdate', 'settingupdate');

    // profile
    Route::get('panel/profile', 'profile');
    Route::put('panel/profileupdate', 'profileupdate');
});
