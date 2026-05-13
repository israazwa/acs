<?php

namespace App\Livewire\Pages\Users;

use Livewire\Component;
use App\Models\VideoPelajaran;
use App\Models\Pelajaran;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]
class Dashboard extends Component
{

    public $videoAktif;
    public $pelajarans;

    public function mount()
    {
        $sekolahId = Auth::user()->sekolah_id;

        // Ambil livestream aktif (streaming_url tidak null)
        $this->videoAktif = VideoPelajaran::whereHas('pelajaran', function ($q) use ($sekolahId) {
            $q->where('sekolah_id', $sekolahId);
        })
            ->whereNotNull('streaming_url')
            ->latest()
            ->first();

        // Ambil semua pelajaran milik sekolah user
        $this->pelajarans = Pelajaran::where('sekolah_id', $sekolahId)->get();
    }
    public function render()
    {
        return view('livewire.pages.users.dashboard');
    }
}
