<div class="min-h-screen bg-gradient-to-b from-gray-100 to-orange-300 py-12 px-6">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-2xl p-8">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">
            Ujian {{ $pelajaran->nama_pelajaran }}
        </h2>

        {{-- Progress bar --}}
        <div class="w-full bg-gray-200 rounded-full h-2 mb-8">
            <div class="bg-orange-500 h-2 rounded-full transition-all duration-500"
                 style="width: {{ ($page / $totalPages) * 100 }}%"></div>
        </div>
        <p class="text-sm text-gray-600 text-center mb-6">
            Halaman {{ $page }} dari {{ $totalPages }}
        </p>

        @if (session()->has('success'))
            <div class="bg-green-500 text-white px-4 py-2 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @foreach($currentSoals as $index => $soal)
            <div class="mb-8">
                <div class="flex gap-2">
                    <p>
                        {{ ($page - 1) * $perPage + $index + 1 }}.
                    </p>
                    <p class="text-gray-800 font-semibold text-xl ">{{ $soal->pertanyaan }}</p>
                </div> 
                <div class="space-y-3">
                    @foreach($soal->jawabans as $jawaban)
                        <label class="flex items-center bg-gray-100 rounded-lg px-4 py-2 cursor-pointer hover:bg-orange-100 transition">
                            <input type="radio" 
                                   wire:model="answers.{{ $soal->id }}" 
                                   value="{{ $jawaban->id }}" 
                                   class="mr-3 accent-orange-500">
                            <span class="text-gray-700">{{ $jawaban->teks_jawaban }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="flex justify-between mt-8">
            <button wire:click="prevPage" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-semibold transition"
                    @if($page === 1) disabled @endif>
                Sebelumnya
            </button>

            @if($page < $totalPages)
                <button wire:click="nextPage" 
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Selanjutnya
                </button>
            @else
                <button wire:click="submit" 
                        class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold transition">
                    Kumpulkan
                </button>
            @endif
        </div>
    </div>
</div>
