<?php

namespace App\Livewire\Pages\Users;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\Sekolah;
use App\Models\VideoPelajaran;
use App\Models\Pelajaran;
use App\Models\ChatVideo;

use Livewire\Attributes\Layout;
#[Layout('layouts.app')]
class Livestreamings extends Component
{
    use WithPagination;

    public $pengumuman;
    public $sekolah;
    public $videoAktif;
    public $videoId;          // tambahkan property ini
    public $chatMessages = [];
    public $newMessage;

    public function mount()
    {
        $user = Auth::user();
        $sekolah = Sekolah::findOrFail($user->sekolah_id);
        $this->pengumuman = $sekolah?->pengumuman;
        $this->sekolah = $sekolah?->nama_sekolah;

        // cari video aktif
        $videoak = VideoPelajaran::with('pelajaran')
            ->whereHas('pelajaran', function ($q) use ($sekolah) {
                $q->where('sekolah_id', $sekolah->id);
            })
            ->whereNotNull('streaming_url')
            ->latest()
            ->first();

        $this->videoAktif = $videoak;
        $this->videoId = $videoak?->id;   // simpan ID video aktif

        $this->loadChat();
    }

    public function loadChat()
    {
        if ($this->videoId) {
            $this->chatMessages = ChatVideo::with('user')
                ->where('video_pelajaran_id', $this->videoId)
                ->latest()
                ->take(30)
                ->get();
        } else {
            $this->chatMessages = collect(); // kosong kalau tidak ada video
        }
    }

    public function sendMessage()
    {
        if (!empty($this->newMessage) && $this->videoId) {
            ChatVideo::create([
                'video_pelajaran_id' => $this->videoId,
                'user_id' => Auth::id(),
                'pesan' => $this->newMessage, // tambahkan field pesan
                'role_pengirim' => Auth::user()->role ?? 'siswa', // opsional: isi role
            ]);

            $this->newMessage = '';
            $this->loadChat();
        }
    }


    public function render()
    {
        $user = Auth::user();
        $pelajarans = Pelajaran::where('sekolah_id', $user->sekolah_id)
            ->orderBy('nama_pelajaran', 'asc')
            ->paginate(5);

        return view('livewire.pages.users.livestreamKelas', [
            'pelajarans' => $pelajarans,
        ]);
    }
}
