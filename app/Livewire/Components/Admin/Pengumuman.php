<?php

namespace App\Livewire\Components\Admin;

use Livewire\Component;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class Pengumuman extends Component
{
    public $sekolahId;
    public $pengumuman;

    protected $rules = [
        'pengumuman' => 'nullable|string|min:5|max:255',
    ];

    public function mount($sekolahId = null)
    {
        $this->sekolahId = $sekolahId ?? auth()->user()->sekolah_id;
        $sekolah = Sekolah::find($this->sekolahId);

        if ($sekolah) {
            $this->pengumuman = $sekolah->pengumuman;
        }
    }

    public function save()
    {
        $this->validate();

        $sekolah = Sekolah::find($this->sekolahId);
        if ($sekolah) {
            $sekolah->update([
                'pengumuman' => $this->pengumuman,
            ]);
            session()->flash('success', 'Pengumuman berhasil diperbarui.');
        }
    }

    public function clear()
    {
        $sekolah = Sekolah::find($this->sekolahId);
        if ($sekolah) {
            $sekolah->update(['pengumuman' => null]);
            $this->pengumuman = null;
            session()->flash('success', 'Pengumuman berhasil dihapus.');
        }
    }

    public function sendEmail()
    {
        $sekolah = Sekolah::find($this->sekolahId);

        if ($sekolah && $this->pengumuman) {
            $users = User::where('sekolah_id', $this->sekolahId)->get();

            foreach ($users as $user) {
                Mail::send('email.pengumuman', [
                    'namaSekolah' => $sekolah->nama_sekolah,
                    'isi' => $this->pengumuman,
                ], function ($message) use ($user, $sekolah) {
                    $message->to($user->email)
                        ->subject("Pengumuman dari {$sekolah->nama_sekolah}");
                });
            }

            session()->flash('success', 'Pengumuman berhasil dikirim ke semua email.');
        }
    }

    public function render()
    {
        return view('livewire.components.admin.pengumuman');
    }
}
