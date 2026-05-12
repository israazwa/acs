<?php

namespace App\Http\Livewire\Components\Users;

use App\Models\VideoPelajaran;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class TabelKelas extends Component
{
    use WithPagination;

    public $pelajaranId;
    public $videos;

    public function mount($pelajaranId)
    {
        $this->pelajaranId = $pelajaranId;
    }

    public function render()
    {
        $sekolahId = Auth::user()->sekolah_id;

        // Simpan hasil query ke properti publik
        $this->videos = VideoPelajaran::where('pelajaran_id', $this->pelajaranId)
            ->whereHas('pelajaran', fn($q) => $q->where('sekolah_id', $sekolahId))
            ->latest()
            ->paginate(2);

        return view('livewire.components.users.tabel-kelas', [
            'videos' => $this->videos,
        ]);
    }
}
