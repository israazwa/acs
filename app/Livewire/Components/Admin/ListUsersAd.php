<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;
use App\Models\Pelajaran;
use App\Models\User;
use App\Models\HasilTest;

use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class ListUsersAd extends Component
{
    public $pelajaranId;
    public $users = [];

    public function updatedPelajaranId()
    {
        $pelajaran = Pelajaran::find($this->pelajaranId);
        if ($pelajaran) {
            // Ambil semua user di sekolah pelajaran ini
            $this->users = User::where('sekolah_id', $pelajaran->sekolah_id)->get();
        }
    }

    public function resetUjian($userId)
    {
        HasilTest::where('user_id', $userId)
            ->where('pelajaran_id', $this->pelajaranId)
            ->delete();

        $this->dispatch('notify', 'Ujian murid berhasil direset.');
    }

    public function tendang($userId)
    {
        User::findOrFail($userId)->delete();
        $this->users = collect($this->users)->reject(fn($u) => $u->id == $userId);
        $this->dispatch('notify', 'Murid berhasil ditendang.');
    }

    public function render()
    {
        return view('livewire.components.admin.list-users-ad', [
            'pelajaranList' => Pelajaran::all(),
            'users' => $this->users,
        ]);
    }
}
