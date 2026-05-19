<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Sekolah;
use App\Models\Pelajaran;
use App\Models\User;

class Home extends Component
{
    public $sekolah;
    public $jumlahPelajaran = 0;
    public $jumlahMurid = 0;

    public function mount()
    {
        $this->loadData();
    }

    // Method untuk refresh data
    public function loadData()
    {
        $this->sekolah = Auth::user()->sekolah;

        if ($this->sekolah) {
            $this->jumlahPelajaran = $this->sekolah->pelajarans()->count();
        }

        $admin = Auth::user();
        $this->jumlahMurid = User::where('sekolah_id', $admin->sekolah_id)
            ->where('role', 'siswa')
            ->count();
    }

    public function render()
    {
        return view('livewire.components.admin.home');
    }
}
