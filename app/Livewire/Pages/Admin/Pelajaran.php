<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\pelajaran as pelajaranMd;

use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class Pelajaran extends Component
{
    public $nama_pelajaran;
    public $deskripsi;
    public $pelajarans;

    public function mount()
    {
        $this->pelajarans = pelajaranMd::where('sekolah_id', Auth::user()->sekolah_id)
            ->latest()
            ->get();
    }
    public function loadPelajarans()
    {
        $this->pelajarans = pelajaranMd::where('sekolah_id', Auth::user()->sekolah_id)
            ->latest()
            ->get();
    }

    public function deletePelajaran($id)
    {
        $pelajaran = pelajaranMd::where('id', $id)
            ->where('sekolah_id', Auth::user()->sekolah_id)
            ->firstOrFail();

        $pelajaran->delete();

        $this->loadPelajarans();

        session()->flash('success', 'Pelajaran berhasil dihapus!');
    }

    public function storePelajaran()
    {
        $this->validate([
            'nama_pelajaran' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        pelajaranMd::create([
            'nama_pelajaran' => $this->nama_pelajaran,
            'deskripsi' => $this->deskripsi,
            'sekolah_id' => Auth::user()->sekolah_id,
        ]);

        $this->reset(['nama_pelajaran', 'deskripsi']);
        $this->mount();

        session()->flash('success', 'Pelajaran berhasil ditambahkan!');
    }

    public function render()
    {
        return view('livewire.pages.admin.pelajaran');
    }
}
