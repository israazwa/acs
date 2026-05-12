<section>
    <div class="">
        <h2 class="text-center text-3xl font-extrabold tracking-wide uppercase text-orange-600" data-aos="fade-up">
            Daftar Pelajaran
        </h2>
        <div class="flex justify-center mt-2" data-aos="fade-up" data-aos-delay="200">
            <span class="inline-block w-52 h-1 bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 rounded-full"></span>
        </div>
        <p class="text-center text-gray-600 mt-3 text-sm" data-aos="fade-up" data-aos-delay="400">
            Pilih pelajaran yang tersedia di sekolahmu
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 px-20 py-2" data-aos="fade-up">
        @forelse($pelajarans as $pelajaran)
            <div class="bg-white shadow-md rounded-lg p-4" data-aos="fade-up" data-aos-delay="200">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">
                    {{ $pelajaran->nama_pelajaran }}
                </h2>

                <ul class="space-y-3">
                    @forelse($pelajaran->videos_paginate as $video)
                        <li class="border rounded-md p-1 bg-gray-50 hover:bg-gray-100 transition" data-aos="fade-up" data-aos-delay="600">
                            <p class="font-medium text-gray-700">
                                Judul: {{ $video->judul_video ?? 'tidak tersedia' }}
                            </p>
                            <p class="text-sm text-gray-600 break-words">
                                Streaming URL:
                                @if(!empty($video->streaming_url))
                                    <a href="{{ $video->streaming_url }}" target="_blank" class="text-blue-600 underline">
                                        {{ $video->streaming_url }}
                                    </a>
                                @else
                                    <span class="italic text-gray-500" >tidak tersedia</span>
                                @endif
                            </p>
                            <p class="text-sm text-gray-600 break-words">
                                Recorded Path:
                                @if(!empty($video->recorded_path))
                                    {{ $video->recorded_path }}
                                @else
                                    <span class="italic text-gray-500">tidak tersedia</span>
                                @endif
                            </p>
                        </li>
                    @empty
                        <li class="text-sm text-gray-500 italic" data-aos="fade-up" data-aos-delay="600">Tidak tersedia</li>
                    @endforelse
                </ul>

                {{-- Pagination khusus video pelajaran ini --}}
                <div class="mt-2">
                    {{ $pelajaran->videos_paginate->links() }}
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500 italic">Tidak ada pelajaran</p>
        @endforelse
    </div>

    {{-- Pagination pelajaran --}}
    <div class="mt-4 p-12">
        {{ $pelajarans->links() }}
    </div>

    <script>
    let lastScrollTop = 0;

    // Simpan posisi scroll sebelum Livewire kirim request
    Livewire.hook('message.sent', () => {
        lastScrollTop = window.scrollY;
    });

    // Restore posisi scroll setelah Livewire selesai render
    Livewire.hook('message.processed', () => {
        window.scrollTo({
            top: lastScrollTop,
            behavior: 'auto' // bisa diganti 'smooth' kalau mau animasi
        });
    });
</script>

</section>
