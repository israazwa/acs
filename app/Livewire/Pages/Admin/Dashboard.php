<?php

namespace App\Livewire\Pages\Admin;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public $jumlahMurid = 0;

    public function mount()
    {
        $admin = Auth::user();

        $this->jumlahMurid = User::query()
            ->where('sekolah_id', $admin->sekolah_id)
            ->where('role', 'siswa')
            ->count('*');

    }
    public function render()
    {
        return view('livewire.pages.admin.dashboard');
    }
}
