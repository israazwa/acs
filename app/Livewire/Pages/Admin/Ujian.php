<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\hasilTest;

use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class Ujian extends Component
{
    public $pelajaranList;
    public function render()
    {
        return view('livewire.pages.admin.ujian');
    }
}
