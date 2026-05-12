
<section>
    <main class="grid grid-cols-1 md:grid-cols-12 gap-8 p-10">
        {{-- Panel Video --}}
        <div class="md:col-span-8 bg-gray-50 rounded-lg shadow-lg overflow-hidden">
            {{-- Header Info --}}
            <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-6 py-3">
                <h2 class="text-lg font-bold text-white tracking-wide">
                    {{ $videoAktif?->pelajaran?->nama_pelajaran ?? 'Pelajaran tidak tersedia' }}
                </h2>
                <p class="text-sm text-orange-100">
                    {{ $videoAktif?->judul_video ?? 'Tidak ada judul' }}
                </p>
            </div>
            
            {{-- Video Player --}}
            <div class="w-full h-[450px] bg-black">
                <iframe 
                    src="{{ $videoAktif?->streaming_url ?? '' }}"
                    title="Video Player"
                    class="w-full h-full"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                </iframe>
            </div>

            {{-- Deskripsi --}}
            <div class="p-6">
                <h3 class="text-base font-semibold text-gray-800 mb-2">Deskripsi</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ $videoAktif?->deskripsi ?? 'Tidak ada deskripsi' }}
                </p>
            </div>
        </div>

        {{-- Panel Samping (Chat/Info) --}}
        <div class="md:col-span-4 bg-gradient-to-b from-gray-50 to-gray-200 rounded-lg shadow-lg p-6 flex flex-col">
            <h3 class="text-lg font-extrabold text-orange-600 uppercase mb-4 text-center">Ruang Diskusi</h3>

            {{-- Daftar Chat --}}
            <div wire:poll.3s="loadChat"
                class="space-y-3 h-96 overflow-y-auto p-2 border rounded-md bg-gray-50">
                @forelse($chatMessages as $chat)
                    @if($chat->user_id === Auth::id())
                        <div class="flex justify-end">
                            <div class="bg-orange-500 text-white rounded-md shadow-sm p-3 max-w-xs">
                                <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                                <p class="text-sm">{{ $chat->pesan }}</p>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-start">
                            <div class="bg-white rounded-md shadow-sm p-3 max-w-xs">
                                <p class="text-sm text-gray-800 font-semibold">{{ $chat->user->name }}</p>
                                <p class="text-sm text-gray-600">{{ $chat->pesan }}</p>
                            </div>
                        </div>
                    @endif
                @empty
                    <p class="text-gray-400 italic">Belum ada pesan.</p>
                @endforelse
            </div>

            {{-- Input Chat --}}
            <div class="mt-4">
                <input type="text"
                    wire:model="newMessage"
                    wire:keydown.enter="sendMessage"
                    placeholder="Tulis pesan..."
                    class="w-full border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-orange-500 focus:outline-none">

                <button wire:click="sendMessage"
                        class="mt-2 w-full bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 rounded-md">
                    Kirim
                </button>
            </div>
        </div>
    </main>

</section>
