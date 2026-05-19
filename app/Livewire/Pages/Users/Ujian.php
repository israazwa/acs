<?php

namespace App\Livewire\Pages\Users;

use Livewire\Component;
use App\Models\pelajaran;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;
#[Layout('layouts.app')]
class Ujian extends Component
{
    public $pelajaran;
    public $soals;
    public function mount(Pelajaran $pelajaran)
    {
        $this->pelajaran = $pelajaran;
        $this->soals = $pelajaran->soals()->with('jawabans')->get();
    }

    public function render()
    {
        return view('livewire.pages.users.ujian');
    }
}
