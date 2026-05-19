<div class="p-8">
    <h1 class="text-2xl font-bold mb-6 text-white">Manajemen Ujian</h1>

    <!-- Pilih Pelajaran -->
    <div class="mb-6">
        <label class="block text-gray-300 mb-2">Pilih Mata Pelajaran</label>
        <select wire:model="pelajaranId" class="w-full bg-gray-800 text-white rounded-lg p-2">
            <option value="">-- Pilih Pelajaran --</option>
            @foreach($pelajaranList as $pelajaran)
                <option value="{{ $pelajaran->id }}">{{ $pelajaran->nama_pelajaran }}</option>
            @endforeach
        </select>
    </div>

    <!-- Tabel User -->
    @if($users && count($users) > 0)
        <table class="min-w-full bg-white border rounded-lg shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Murid</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <button wire:click="resetUjian({{ $user->id }})"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                Reset Ujian
                            </button>
                            <button wire:click="tendang({{ $user->id }})"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Tendang
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @elseif($pelajaranId)
        <p class="text-gray-400 mt-4">Belum ada murid untuk pelajaran ini.</p>
    @endif
</div>
