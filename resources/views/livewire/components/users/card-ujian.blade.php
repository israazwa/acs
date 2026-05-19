<div class="min-h-screen">
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <section>
        <div class=" flex flex-col items-center pt-10 px-8">
            <h2 class="text-center text-3xl font-extrabold tracking-wide uppercase text-orange-600" data-aos="fade-up">
                Ujian Terbaru
            </h2>
            <div class="flex justify-center mt-2 mb-4" data-aos="fade-up" data-aos-delay="200">
                <span class="inline-block w-52 h-1 bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 rounded-full"></span>
            </div>
        
            {{-- Bagian 3 terbaru --}}
            <div class="flex flex-wrap justify-center gap-6 w-full max-w-6xl mb-10">
                @forelse($pelajaranTerbaru as $pelajaran)
                    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between w-full md:w-1/2 lg:w-1/3" data-aos="fade-up" data-aos-delay="600">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700">{{ $pelajaran->nama_pelajaran }}</h2>
                            <p class="text-gray-500 mt-2">
                                {{ $pelajaran->deskripsi ?? 'Belum ada deskripsi.' }}
                            </p>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <span class="text-sm text-gray-600">
                                {{ $pelajaran->soals->count() }} Soal tersedia
                            </span>
                            <a href="{{ route('ujian.show', $pelajaran->id) }}"
                            class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded">
                                Mulai Ujian
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 italic w-full">
                        Belum ada ujian terbaru.
                    </div>
                @endforelse
            </div>

            {{-- Bagian pelajaran lain --}}
            <div class="mt-10">
                <h2 class="text-center text-3xl font-extrabold tracking-wide uppercase text-orange-600" data-aos="fade-up">
                    Daftar Ujian Lainnya
                </h2>
                <div class="flex justify-center mt-2 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <span class="inline-block w-72 h-1 bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 rounded-full"></span>
                </div>
            </div>    
            <div class="flex flex-wrap justify-center gap-3 w-full ">
                @forelse($pelajaranLain as $pelajaran)
                    <div data-aos="fade-up" data-aos-delay="800" class="bg-white shadow-md rounded-lg p-6 flex flex-col justify-between w-full md:w-1/2 lg:w-1/3">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-700">{{ $pelajaran->nama_pelajaran }}</h2>
                            <p class="text-gray-500 mt-2">
                                {{ $pelajaran->deskripsi ?? 'Belum ada deskripsi.' }}
                            </p>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            @if($pelajaran->soals->isNotEmpty())
                                <span class="text-sm text-gray-600">
                                    {{ $pelajaran->soals->count() }} Soal tersedia
                                </span>
                                <a href="{{ route('ujian.show', $pelajaran->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                                    Mulai Ujian
                                </a>
                            @else
                                <span class="text-sm text-red-500">Belum ada soal</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 italic w-full">
                        Tidak ada pelajaran lain.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
     <div data-aos="fade-up" data-aos-delay="800" class="mx-10 md:mx-60 p-10">{{ $pelajaranLain->links() }}</div>
</div>