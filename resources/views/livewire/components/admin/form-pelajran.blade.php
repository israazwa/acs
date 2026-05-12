<div class="bg-gray-800 rounded-md shadow-md p-6">
    <h2 class="text-xl font-bold text-gray-100 mb-6">Tambah Pelajaran Baru</h2>

    @if(session()->has('success'))
        <div class="mb-4 p-3 bg-green-600 text-white rounded-md">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Input --}}
    <form wire:submit.prevent="storePelajaran" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-200 mb-1">Nama Pelajaran</label>
            <input type="text" wire:model="nama_pelajaran"
                   class="w-full rounded-md bg-gray-900 text-gray-100 border border-gray-700 px-3 py-2 focus:ring-2 focus:ring-orange-500"
                   placeholder="Masukkan nama pelajaran">
            @error('nama_pelajaran') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-200 mb-1">Deskripsi</label>
            <textarea wire:model="deskripsi"
                      class="w-full rounded-md bg-gray-900 text-gray-100 border border-gray-700 px-3 py-2 focus:ring-2 focus:ring-orange-500"
                      rows="4"
                      placeholder="Tuliskan deskripsi pelajaran..."></textarea>
            @error('deskripsi') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-5 py-2 rounded-md transition">
                Simpan
            </button>
        </div>
    </form>
</div>

{{-- Daftar Pelajaran --}}
<div class="bg-gray-900 rounded-md shadow-md p-6 mt-6">
    <h2 class="text-lg font-bold text-gray-100 mb-4">Daftar Pelajaran</h2>

    @if($pelajarans->isEmpty())
        <p class="text-gray-400 italic">Belum ada pelajaran.</p>
    @else
        <table class="min-w-full border border-gray-700 rounded-md">
            <thead class="bg-gray-700 text-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold">#</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Nama Pelajaran</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold">Deskripsi</th>
                    <th class="px-4 py-2 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach($pelajarans as $index => $pelajaran)
                    <tr class="hover:bg-gray-800 transition">
                        <td class="px-4 py-2 text-sm text-gray-300">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 text-sm text-gray-100">{{ $pelajaran->nama_pelajaran }}</td>
                        <td class="px-4 py-2 text-sm text-gray-400">{{ $pelajaran->deskripsi ?? '-' }}</td>
                        <td class="px-4 py-2 text-center">
                            <button wire:click="deletePelajaran({{ $pelajaran->id }})"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
