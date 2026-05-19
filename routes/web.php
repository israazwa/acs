<?php

use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Admin\LivestreamingAd;
use App\Livewire\Pages\Admin\Pelajaran;
use App\Livewire\Pages\Auth\KodeUnique;
use App\Livewire\Pages\Unlog\RegisAdmin;
use App\Livewire\Pages\Users\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Users\Dashboard as ds;
use App\Http\Controllers\GoogleController;
use App\Livewire\Components\Admin\HasilTestAd;
use App\Livewire\Components\Admin\Home as AdminHome;
use App\Livewire\Components\Admin\Pengumuman;
use App\Livewire\Components\Admin\UserMng;
use App\Livewire\Components\Users\FormUjian;
use App\Livewire\Components\Users\SkorNilai;
use App\Livewire\Pages\Admin\CrudUjian;
use App\Livewire\Pages\Admin\Ujian as AdminUjian;
use App\Livewire\Pages\Admin\UsersManagement;
use App\Livewire\Pages\Users\HasilUjian;
use App\Livewire\Pages\Users\ListUjian;
use App\Livewire\Pages\Users\Ujian;

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('welcome');
})->name('wh');
Route::get('/adminregister', RegisAdmin::class)->name('register.admin');
Route::get('/kodeunik', KodeUnique::class)->name('kodeunik');

Route::middleware(['auth', 'role:superadmin'])->group(function () {

});

Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/pelajaran', Pelajaran::class)->name('admin.pelajaran');
    Route::get('/admin/ujian', CrudUjian::class)->name('admin.ujian');
    Route::get('/admin/api/pengumuman', Pengumuman::class)->name('admin.api.pengumuman');
    Route::get('/admin/api/home', AdminHome::class)->name('admin.api.home');
    Route::get('/admin/livestreaming', LivestreamingAd::class)->name('admin.livestreaming');
    Route::get('/admin/hasil/ujian', AdminUjian::class)->name('admin.hasil.ujian');
    Route::get('/admin/hasil/ujian', HasilTestAd::class)->name('admin.hasil.ujian');
    Route::get('/admin/managementUsers', UsersManagement::class)->name('admin.user');
    Route::get('/admin/control/user', UserMng::class)->name('admin.manageUsers');

});

Route::middleware(['auth', 'role:siswa,admin,superadmin'])->group(function () {
    Route::get('/home', Home::class)->name('home');
    Route::get('/livestreaming', \App\Livewire\Pages\Users\Livestreamings::class)->name('users.live');
    Route::get('/kelas', ds::class)->name('kelas');
    Route::get('/ujian', ListUjian::class)->name('ujian');
    Route::get('/ujian/{pelajaranId}', Ujian::class)->name('ujian.show');
    Route::get('/ujian/{pelajaranId}', FormUjian::class)->name('ujian.show');
    // Route::get('/ujian/{pelajaranId}/hasil', HasilUjian::class)->name('ujian.hasil');
    Route::get('/ujian/{pelajaranId}/hasil', SkorNilai::class)->name('ujian.hasil');



    // Video Pembelajaran
    Route::get('/video-pembelajaran', function () {
        return view('video'); // resources/views/video.blade.php
    })->name('video');

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
