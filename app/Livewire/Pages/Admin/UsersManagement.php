<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;

use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class UsersManagement extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.users-management');
    }
}
