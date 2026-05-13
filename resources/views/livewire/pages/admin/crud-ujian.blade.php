<section>
    @if(session('success'))
    <div class="bg-green-600 text-white p-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-600 text-white p-2 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

    <div class="p-6 bg-gray-800 text-white rounded-lg">
        {{-- Pilih pelajaran dulu --}}
        <div class="mb-4">
            <label class="block text-sm">Pilih Pelajaran</label>
            <select wire:model.defer="selectedPelajaran" class="w-full bg-gray-700 rounded px-2 py-2">
                <option value="">-- Pilih Pelajaran --</option>
                @foreach($pelajarans as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_pelajaran }}</option>
                @endforeach
            </select>

            <button wire:click="filterPelajaran" class="bg-blue-600 px-4 py-2 rounded mt-2">
                Tampilkan Soal
            </button>
        </div>

        {{-- Form CRUD hanya muncul jika pelajaran sudah dikonfirmasi --}}
        @if($confirmedPelajaran)
            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}" class="space-y-4">
               <input type="hidden" wire:model="pelajaran_id">
                <div>
                    <label class="block text-sm">Pelajaran</label>
                    <input type="text" 
                        value="{{ optional($confirmedPelajaran)->nama_pelajaran }}" 
                        class="w-full bg-gray-700 rounded px-2 py-2" 
                        readonly>
                </div>


                <div>
                    <label class="block text-sm">Pertanyaan</label>
                    <textarea wire:model="pertanyaan" class="w-full bg-gray-700 rounded px-2 py-2"></textarea>
                    @error('pertanyaan') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm">Opsi Jawaban</label>
                    @foreach(range(0,3) as $i)
                        <div class="flex items-center gap-2 mb-2">
                            <input type="text" wire:model="jawabanList.{{ $i }}" 
                                class="w-full bg-gray-700 rounded px-2 py-2" 
                                placeholder="Jawaban {{ chr(65+$i) }}">
                            <input type="radio" wire:model="jawabanBenarIndex" value="{{ $i }}">
                            <span class="text-sm">Benar</span>
                        </div>
                    @endforeach
                    @error('jawabanBenarIndex') <span class="text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-4">
                    <button type="submit" class="bg-orange-600 px-4 py-2 rounded">
                        {{ $updateMode ? 'Update' : 'Simpan' }}
                    </button>
                    @if($updateMode)
                        <button type="button" wire:click="resetInput" class="bg-gray-600 px-4 py-2 rounded">Batal</button>
                    @endif
                </div>
            </form>

            <hr class="my-6 border-gray-600">

            {{-- Tabel soal khusus pelajaran terpilih --}}
            <h3 class="text-lg mb-2">Daftar Soal: {{ optional($pelajarans->find($pelajaran_id))->nama_pelajaran }}</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-700 text-left">
                        <th class="px-2 py-2">Pertanyaan</th>
                        <th class="px-2 py-2">Jawaban Benar</th>
                        <th class="px-2 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($soals as $s)
                        <tr class="border-b border-gray-600">
                            <td class="px-2 py-2">{{ Str::limit($s->pertanyaan, 50) }}</td>
                            <td class="px-2 py-2">{{ optional($s->jawabans->firstWhere('is_benar', true))->teks_jawaban }}</td>
                            <td class="px-2 py-2 flex gap-2">
                                <button wire:click="edit({{ $s->id }})" class="bg-blue-600 px-2 py-1 rounded">Edit</button>
                                <button wire:click="delete({{ $s->id }})" class="bg-red-600 px-2 py-1 rounded">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $soals->links() }}
        @endif
    </div>

</section>