<?php

use App\Livewire\Pages\Admin\Dashboard;
use App\Livewire\Pages\Admin\LivestreamingAd;
use App\Livewire\Pages\Admin\Pelajaran;
use App\Livewire\Pages\Unlog\RegisAdmin;
use App\Livewire\Pages\Users\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('welcome');
});
Route::get('/adminregister', RegisAdmin::class)->name('register.admin');

Route::middleware(['auth', 'role:superadmin'])->group(function () {

});

Route::middleware(['auth', 'role:admin,superadmin'])->group(function () {
    Route::get('admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('admin/pelajaran', Pelajaran::class)->name('admin.pelajaran');
    Route::get('admin/livestreaming', LivestreamingAd::class)->name('admin.livestreaming');
});

Route::middleware(['auth', 'role:siswa,admin,superadmin'])->group(function () {
    Route::get('/home', Home::class)->name('users.home');
    Route::get('/livestreaming', \App\Livewire\Pages\Users\Livestreamings::class)->name('users.live');
    Route::get('/kelas', \App\Livewire\Pages\Users\Dashboard::class)->name('users.kelas');
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
