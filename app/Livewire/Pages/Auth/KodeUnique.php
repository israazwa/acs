<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Sekolah;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.guest')]
class KodeUnique extends Component
{
    public string $kode_unik = '';

    public function submit()
    {
        $this->validate([
            'kode_unik' => 'required|string',
        ]);

        // cek sekolah
        $sekolah = Sekolah::where('kode_unik', $this->kode_unik)->first();
        if (!$sekolah) {
            $this->addError('kode_unik', 'Kode unik tidak valid.');
            return;
        }

        // ambil user dari session google
        $googleUser = session('google_user');
        if (!$googleUser) {
            return redirect('/login')->with('error', 'Session Google tidak ditemukan.');
        }

        // karena $googleUser adalah array, akses dengan index
        $user = User::where('email', $googleUser['email'])->first();
        if (!$user) {
            return redirect('/login')->with('error', 'User tidak ditemukan.');
        }

        // update user
        $user->update([
            'sekolah_id' => $sekolah->id,
            'kode_unik' => $this->kode_unik,
        ]);


        Auth::login($user);
        session()->forget('google_user');

        return redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.pages.auth.kode-unique');
    }
}
