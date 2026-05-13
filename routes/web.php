<?php

use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Admin\LivestreamingAd;
use App\Livewire\Pages\Admin\Pelajaran;
use App\Livewire\Pages\Unlog\RegisAdmin;
use App\Livewire\Pages\Users\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Users\Dashboard as ds;
use App\Http\Controllers\GoogleController;
use App\Livewire\Pages\Admin\CrudUjian;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('welcome');
})->name('wh');
Route::get('/adminregister', RegisAdmin::class)->name('register.admin');

Route::middleware(['auth', 'role:superadmin'])->group(function () {

});

Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::get('admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('admin/pelajaran', Pelajaran::class)->name('admin.pelajaran');
    Route::get('admin/ujian', CrudUjian::class)->name('admin.ujian');
    Route::get('admin/livestreaming', LivestreamingAd::class)->name('admin.livestreaming');
});

Route::middleware(['auth', 'role:siswa,admin,superadmin'])->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/livestreaming', \App\Livewire\Pages\Users\Livestreamings::class)->name('users.live');
    Route::get('/kelas', ds::class)->name('kelas');

    // Video Pembelajaran
    Route::get('/video-pembelajaran', function () {
        return view('video'); // resources/views/video.blade.php
    })->name('video');

    // Ujian
    Route::get('/ujian', function () {
        return view('ujian'); // resources/views/ujian.blade.php
    })->name('ujian');

    // Profile
    Route::get('/profile', function () {
        return view('profile'); // resources/views/profile.blade.php
    })->name('profile');

});


Route::redirect('/dashboard', '/home')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

require __DIR__ . '/auth.php';
