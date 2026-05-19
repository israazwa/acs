<?php

namespace App\Livewire\Components\Users;

use Livewire\Component;
use App\Models\Pelajaran;
use App\Models\HasilTest;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]
class SkorNilai extends Component
{
    public $pelajaran;
    public $hasil;

    public function mount($pelajaranId)
    {
        $this->pelajaran = Pelajaran::findOrFail($pelajaranId);

        $this->hasil = HasilTest::where('user_id', Auth::id())
            ->where('pelajaran_id', $this->pelajaran->id)
            ->latest()
            ->first();
    }


    public function render()
    {
        return view('livewire.components.users.skor-nilai', [
            'pelajaran' => $this->pelajaran,
            'hasil' => $this->hasil,
            'user' => Auth::user(),
        ]);
    }
}
