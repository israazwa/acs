<?php

namespace App\Livewire\Pages\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Pelajaran;
use App\Models\HasilTest;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]
class HasilUjian extends Component
{
    public $pelajaran;
    public $hasil;
    public $user;

    // Route model binding: otomatis inject Pelajaran dari URL
    public function mount(Pelajaran $pelajaran)
    {
        $this->pelajaran = $pelajaran;

        // Ambil hasil ujian terakhir untuk user login
        $this->hasil = HasilTest::where('user_id', Auth::id())
            ->where('pelajaran_id', $pelajaran->id)
            ->latest()
            ->first();

        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.pages.users.hasil-ujian', [
            'pelajaran' => $this->pelajaran,
            'hasil' => $this->hasil,
            'user' => $this->user,
        ]);
    }
}
