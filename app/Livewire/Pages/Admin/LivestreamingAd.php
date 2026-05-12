<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use App\Models\VideoPelajaran;
use App\Models\Pelajaran;
use App\Models\ChatVideo;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\Layout;
#[Layout('layouts.admin')]
class LivestreamingAd extends Component
{
    public $videoId;
    public $videoAktif;
    public $chatMessages = [];
    public $newMessage;
    public $viewerCount = 0;
    public $muteChat = false;

    // Form input untuk admin
    public $pelajaran_id;
    public $judul_video;
    public $streaming_url;
    public $deskripsi;

    /**
     * Kirim pesan ke chat
     */
    public function sendMessage()
    {
        if ($this->muteChat)
            return;

        if (!empty($this->newMessage) && $this->videoId) {
            ChatVideo::create([
                'video_pelajaran_id' => $this->videoId,
                'user_id' => Auth::id(),
                'pesan' => $this->newMessage,
                'role_pengirim' => Auth::user()->role ?? 'siswa',
                'is_pinned' => false,
            ]);

            $this->newMessage = '';
            $this->loadChat();
        }
    }

    /**
     * Pin / Unpin pesan
     */
    public function togglePin($chatId)
    {
        $chat = ChatVideo::find($chatId);

        if ($chat && in_array(Auth::user()->role, ['admin', 'guru'])) {
            $chat->update(['is_pinned' => !$chat->is_pinned]);
            $this->loadChat();
        }
    }

    /**
     * Load video aktif + chat
     */
    public function mount()
    {
        $user = Auth::user();
        $sekolahId = $user->sekolah_id;

        // Ambil livestream aktif (hanya satu)
        $this->videoAktif = VideoPelajaran::whereHas('pelajaran', function ($q) use ($sekolahId) {
            $q->where('sekolah_id', $sekolahId);
        })
            ->whereNotNull('streaming_url')
            ->latest()
            ->first();

        $this->videoId = $this->videoAktif?->id;

        $this->loadChat();
    }

    /**
     * Buat livestream baru (dicek dulu apakah sudah ada aktif)
     */
    public function storeLivestream()
    {
        $user = Auth::user();
        $sekolahId = $user->sekolah_id;

        $cekAktif = VideoPelajaran::whereHas('pelajaran', function ($q) use ($sekolahId) {
            $q->where('sekolah_id', $sekolahId);
        })
            ->whereNotNull('streaming_url')
            ->exists();

        if ($cekAktif) {
            session()->flash('error', 'Masih ada livestream aktif. Matikan dulu sebelum membuat baru.');
            return;
        }

        $this->validate([
            'pelajaran_id' => 'required|exists:pelajarans,id',
            'judul_video' => 'required|string|max:255',
            'streaming_url' => 'required|url',
            'deskripsi' => 'nullable|string',
        ]);

        $video = VideoPelajaran::create([
            'pelajaran_id' => $this->pelajaran_id,
            'judul_video' => $this->judul_video,
            'streaming_url' => $this->streaming_url,
            'deskripsi' => $this->deskripsi,
        ]);

        $this->videoId = $video->id;
        $this->videoAktif = $video;
        $this->reset(['pelajaran_id', 'judul_video', 'streaming_url', 'deskripsi']);

        session()->flash('success', 'Livestream berhasil diset!');
    }

    /**
     * Load chat messages
     */
    public function loadChat()
    {
        if ($this->videoId) {
            $this->chatMessages = ChatVideo::with('user')
                ->where('video_pelajaran_id', $this->videoId)
                ->orderByDesc('is_pinned') // pinned di atas
                ->latest()
                ->take(50)
                ->get();
        } else {
            $this->chatMessages = collect();
        }
    }

    /**
     * Mute/unmute chat
     */
    public function toggleMuteChat()
    {
        $this->muteChat = !$this->muteChat;
    }

    /**
     * Akhiri livestream
     */
    public function endStream()
    {
        if ($this->videoAktif) {
            $this->videoAktif->update(['streaming_url' => null]);
            $this->videoAktif = null;
            $this->videoId = null;
            $this->chatMessages = collect();
        }
    }

    public function render()
    {
        $user = Auth::user();

        $pelajarans = Pelajaran::query()
            ->when($user?->sekolah_id, fn($q) => $q->where('sekolah_id', $user->sekolah_id))
            ->get();

        return view('livewire.pages.admin.livestreaming', [
            'pelajarans' => $pelajarans,
        ]);
    }
}
