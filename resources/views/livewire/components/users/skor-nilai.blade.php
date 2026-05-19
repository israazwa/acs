
<section>

    <div class="min-h-screen bg-gradient-to-b from-gray-100 to-orange-200 py-8 px-4 shadow-2xl">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6 mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">
                Hasil Ujian <br> {{ $pelajaran->nama_pelajaran }}
            </h2>

            @if($hasil)
                <div class="flex flex-col md:flex-row items-center md:items-start md:justify-between gap-6">
                    <!-- Nilai -->
                    <div class="flex-1 text-center">
                        <p class="text-base text-gray-700 mb-1 font-semibold">Nilai Anda</p>
                        <div class="text-6xl font-extrabold text-orange-600">
                            {{ $hasil->nilai }}
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div class="flex-1 text-center md:text-left space-y-2">
                        <p class="text-base text-gray-700">
                            <span class="font-semibold">Nama Peserta:</span> {{ $user->name }}
                        </p>
                        <p class="text-base text-gray-700">
                            <span class="font-semibold">Status:</span>
                            @if($hasil->status_kelulusan)
                                <span class="text-green-600 font-semibold">Lulus</span>
                            @else
                                <span class="text-red-600 font-semibold">Tidak Lulus</span>
                            @endif
                        </p>
                        <p class="font-mono text-xs mt-2">
                            <span class="bg-orange-600 text-white rounded-sm py-0.5 px-3">
                                dikerjakan pada {{ $hasil->created_at }}
                            </span>
                        </p>
                    </div>
                </div>
                <div class="mt-8 border-b border-gray-200"></div>
            @else
                <p class="text-gray-500 text-center">Belum ada hasil ujian untuk pelajaran ini.</p>
            @endif

            <!-- Tombol Navigasi -->
            <div class="mt-8 flex justify-center space-x-3">
                <a href="{{ route('dashboard') }}" 
                class="bg-blue-600 hover:bg-orange-700 text-white px-5 py-2 rounded-md font-semibold transition">
                    Dashboard
                </a>
                <a href="{{ route('ujian') }}" 
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-md font-semibold transition">
                    List Ujian
                </a>
            </div>
        </div>
    </div>
    @include('unlogin.footer')
</section>
