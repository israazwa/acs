<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UserMng extends Component
{
    use WithPagination;

    // jangan simpan paginator di property
    protected $paginationTheme = 'tailwind'; // biar pagination rapi

    public function kick($userId)
    {
        if ($userId == auth()->id()) {
            $this->dispatch('notify', message: 'Anda tidak bisa menendang diri sendiri!');
            return;
        }

        $user = User::findOrFail($userId);
        $user->delete();

        $this->dispatch('notify', message: 'User berhasil ditendang!');
    }


    public function resetExam($userId)
    {
        $user = User::findOrFail($userId);
        $user->examAnswers()->delete();
        $user->examResults()->delete();

        $this->dispatch('notify', message: 'Jawaban dan nilai ujian berhasil direset!');
    }

    public function toggleRole($userId)
    {
        if ($userId == auth()->id()) {
            $this->dispatch('notify', message: 'Anda tidak bisa mengubah role diri sendiri!');
            return;
        }

        $user = User::findOrFail($userId);
        $user->role = $user->role === 'user' ? 'admin' : 'user';
        $user->save();

        $this->dispatch('notify', message: "Role {$user->name} berhasil diubah menjadi {$user->role}!");
    }

    public function render()
    {
        // ambil data langsung di render
        return view('livewire.components.admin.user-mng', [
            'users' => User::paginate(10),
        ]);
    }
}
