<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="flex items-center justify-center bg-gradient-to-b from-gray-100 to-orange-200 min-h-screen">
        <div class="rounded-md p-8 w-full max-w-5xl">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Pilih Mode Belajar</h1>
            <p class="text-gray-600 mb-8 text-center">
                Silakan pilih apakah ingin menonton siaran langsung atau rekaman pelajaran.
            </p>

            {{-- Susunan vertikal: Live di atas, Rekaman di bawah --}}
            <div class="space-y-6">
                
                {{-- Panel Livestream --}}
                <div class="bg-gray-100 rounded-md shadow p-6">
                    <h2 class="text-xl font-bold text-orange-600 mb-3">Live Streaming</h2>
                    @if($videoAktif)
                        <p class="text-gray-800 font-semibold">{{ $videoAktif->judul_video }}</p>
                        <p class="text-sm text-gray-600">Pelajaran: {{ $videoAktif->pelajaran->nama_pelajaran }}</p>
                        <p class="text-sm text-gray-700 mt-2">{{ $videoAktif->deskripsi }}</p>
                        <a href="{{ route('users.live') }}"
                        class="mt-4 inline-block bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-md">
                            Lihat Live
                        </a>
                    @else
                        <p class="text-gray-400 italic">Belum ada livestreaming aktif.</p>
                    @endif
                </div>

                {{-- Panel Rekaman --}}
                <div class="bg-gray-100 rounded-md shadow p-6">
                    <h2 class="text-xl font-bold text-blue-600 mb-3">Rekaman Video</h2>
                    @forelse($pelajarans as $pelajaran)
                        <div class="mb-4">
                            <p class="text-gray-800 font-semibold">{{ $pelajaran->nama_pelajaran }}</p>
                            <p class="text-sm text-gray-600">
                                Jumlah rekaman: {{ $pelajaran->videoPelajarans()->whereNotNull('recorded_path')->count() }}
                            </p>
                            <a href=""
                            class="mt-2 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded-md text-sm">
                                Lihat Rekaman
                            </a>
                        </div>
                    @empty
                        <p class="text-gray-400 italic">Belum ada rekaman tersedia.</p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

</div>
