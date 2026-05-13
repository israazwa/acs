<?php

namespace App\Livewire\Pages\Users;

use App\Models\pelajaran;
use App\Models\videoPelajaran;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app')]
class Home extends Component
{
    use WithPagination;
    public $videoAktif;

    public function mount()
    {
        $sekolahId = Auth::user()->sekolah_id;

        $this->videoAktif = VideoPelajaran::whereHas('pelajaran', function ($q) use ($sekolahId) {
            $q->where('sekolah_id', $sekolahId);
        })
            ->whereNotNull('streaming_url')
            ->latest()
            ->first();
    }
    public function render()
    {
        $sekolahId = Auth::user()->sekolah_id;

        // paginate pelajaran (misalnya 4 per halaman)
        $pelajarans = pelajaran::where('sekolah_id', $sekolahId)
            ->latest()
            ->paginate(4)
            ->withQueryString();

        // paginate video per pelajaran (max 2 per halaman)
        foreach ($pelajarans as $pelajaran) {
            $pelajaran->videos_paginate = $pelajaran->videoPelajarans()
                ->latest()
                ->paginate(2, ['*'], 'video_page_' . $pelajaran->id)
                ->withQueryString();
        }

        return view('livewire.pages.users.home', [
            'pelajarans' => $pelajarans
        ]);
    }
}
