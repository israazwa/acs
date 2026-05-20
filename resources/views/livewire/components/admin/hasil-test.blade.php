<div class="p-8">
    <h1 class="text-2xl font-bold mb-6 text-white">Rekap Ujian</h1>

    <!-- Daftar Pelajaran -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach($pelajaranList as $pelajaran)
            <div class="bg-gray-700 shadow-lg rounded-md p-6 flex flex-col justify-between transition transform hover:-translate-y-1 hover:shadow-xl">
                <div>
                    <h2 class="text-xl font-semibold text-white">{{ $pelajaran->nama_pelajaran }}</h2>
                    <p class="text-gray-400 mt-2">{{ $pelajaran->deskripsi ?? 'Belum ada deskripsi.' }}</p>
                </div>
                <div class="mt-6 flex justify-between items-center">
                    <span class="text-sm text-gray-300">{{ $pelajaran->soals_count }} Soal</span>
                    <button wire:click="showHasil({{ $pelajaran->id }})"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition">
                        Lihat Hasil
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination untuk card pelajaran -->
    <div class="mt-6">
        {{ $pelajaranList->links() }}
    </div>

    <!-- Detail Hasil -->
    @if($selectedPelajaran)
        <h2 class="text-xl font-bold mb-4 text-white uppercase">Hasil Ujian: <span class="text-orange-300">{{ $selectedPelajaran->nama_pelajaran }}</span> </h2>
        <div class="flex justify-between content-between">
            <button wire:click="exportPdf"
                class="px-4 py-2 mb-2 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-sm shadow-md transition">
                    Cetak PDF
            </button>
            <p class="text-right text-gray-200">
            Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i') }}
            </p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg shadow">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Nilai</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hasilTests as $hasil)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $hasil->user->name }}</td>
                            <td class="px-4 py-2 font-semibold text-blue-600">{{ $hasil->nilai }}</td>
                            <td class="px-4 py-2">
                                @if($hasil->status_kelulusan)
                                    <span class="text-green-600 font-semibold">Lulus</span>
                                @else
                                    <span class="text-red-600 font-semibold">Tidak Lulus</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 flex gap-2">
                                <!-- Reset Ujian -->
                                <button onclick="if(confirm('Yakin reset ujian murid ini?')) @this.resetUjian({{ $hasil->user->id }})"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                    Reset Ujian
                                </button>

                                <!-- Tendang Murid -->
                                <button onclick="if(confirm('Yakin ingin menendang murid ini?')) @this.tendang({{ $hasil->user->id }})"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Tendang
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada hasil ujian.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
        <!-- Pagination untuk hasil murid -->
        <div class="mt-6">
            {{ $hasilTests->links() }}
        </div>
    @endif
</div>
