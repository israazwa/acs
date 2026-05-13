<div>
    <section class="p-16 rounded-lg ">
        <div class="text-center p-8">    
            <h2 data-aos="fade-up" data-aos-delay="200" class="text-center text-3xl font-extrabold tracking-wide uppercase text-orange-600" data-aos="fade-up">
             Fitur
            </h2>
            <div class="flex justify-center mt-2" data-aos="fade-up" data-aos-delay="200">
                <span class="inline-block w-32 h-1 bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 rounded-full"></span>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div x-data="{ showModal: false }" data-aos="fade-up">
                @if($videoAktif)
                    <!-- Jika ada livestreaming -->
                    <a href="/livestreaming" 
                    class="flex flex-col items-center justify-center p-6 rounded-lg shadow-lg hover:bg-indigo-300 hover:text-indigo-600
                            bg-orange-600 text-white hover:shadow-2xl hover:scale-105 transition-all duration-300 ease-in-out">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 mb-3">
                            <img src="{{ asset('play.svg') }}" alt="Live Streaming" class="w-8 h-8">
                        </div>
                        <p class="text-base font-semibold">Live Streaming</p>
                        <p class="text-sm font-mono">Livestreaming {{ $videoAktif->judul_video }}</p>
                    </a>
                @else
                    <!-- Jika tidak ada livestreaming -->
                    <a @click="showModal = true"
                            class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow-lg
                                hover:shadow-2xl hover:scale-105 hover:bg-gray-500 hover:text-white transition-all duration-300 ease-in-out">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 mb-3">
                            <img src="{{ asset('play.svg') }}" alt="Live Streaming" class="w-8 h-8">
                        </div>
                        <p class="text-base font-semibold">Live Streaming</p>
                        <p class="text-sm text-center">Tidak ada livestreaming yang berlangsung</p>
                    </a>

                    <!-- Modal -->
                    <div x-show="showModal" x-transition
                        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                        <div class="bg-white rounded-lg shadow-lg p-6 w-80 text-center">
                            <h2 class="text-lg font-bold text-gray-800 mb-4">Informasi</h2>
                            <p class="text-gray-600 mb-6">Saat ini tidak ada live streaming yang tersedia.</p>
                            <button @click="showModal = false"
                                    class="px-4 py-2 bg-orange-600 text-white rounded-md hover:bg-orange-700 transition">
                                Tutup
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <a href="/kelas" data-aos="fade-up" data-aos-delay="600"
            class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow-lg 
                    transform hover:scale-105 hover:bg-orange-600 hover:text-white 
                    transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 mb-3">
                    <img src="{{ asset('class.svg') }}" alt="Daftar Kelas" class="w-8 h-8">
                </div>
                <p class="text-base font-semibold">Daftar Kelas</p>
            </a>

            <!-- Ujian -->
            <a href="/ujian" data-aos="fade-up" data-aos-delay="800"
            class="flex flex-col items-center justify-center p-6 bg-white rounded-lg shadow-lg 
                    transform hover:scale-105 hover:bg-orange-600 hover:text-white 
                    transition-all duration-300 ease-in-out">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-orange-100 mb-3">
                    <img src="{{ asset('sqpen.svg') }}" alt="Ujian" class="w-8 h-8">
                </div>
                <p class="text-base font-semibold">Ujian</p>
            </a>

        </div>
    </section>
</div>
