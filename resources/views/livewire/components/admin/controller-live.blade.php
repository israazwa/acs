<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 p-6 bg-gray-800 rounded-md ">
    {{-- Form Admin --}}
    <div class="lg:col-span-1 bg-gray-900 rounded-md shadow-md p-4">
        <h2 class="text-lg font-bold text-gray-100 mb-4">Set Livestream</h2>

        @if (session()->has('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-700 font-semibold">
                {{ session('error') }}
            </div>
        @endif


        <form wire:submit.prevent="storeLivestream" class="space-y-3">
            <div>
                <label class="text-sm text-gray-200">Pelajaran</label>
                <select wire:model="pelajaran_id"
                        class="w-full rounded-md bg-gray-800 text-gray-100 border border-gray-700 px-2 py-2">
                    <option value="">-- Pilih Pelajaran --</option>
                    @foreach($pelajarans as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_pelajaran }}</option>
                    @endforeach
                </select>
                @error('pelajaran_id') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-sm text-gray-200">Judul Video</label>
                <input type="text" wire:model="judul_video"
                       class="w-full rounded-md bg-gray-800 text-gray-100 border border-gray-700 px-2 py-2"
                       placeholder="Judul video">
                @error('judul_video') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-sm text-gray-200">Platform Streaming</label>
                <select wire:model="platform" required
                        class="w-full rounded-md bg-gray-800 text-gray-100 border border-gray-700 px-2 py-2">
                    <option value="">-- Pilih Platform --</option>
                    <option value="yt">YouTube</option>
                    <option value="custom">Custom URL</option>
                </select>
            </div>

            <div>
                <label class="text-sm text-gray-200">Streaming URL / Video ID</label>
                <input type="text" wire:model="streaming_url"
                    class="w-full rounded-md bg-gray-800 text-gray-100 border border-gray-700 px-2 py-2"
                    placeholder="Masukkan URL atau Video ID">
                @error('streaming_url') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>


            <div>
                <label class="text-sm text-gray-200">Deskripsi</label>
                <textarea wire:model="deskripsi"
                          class="w-full rounded-md bg-gray-800 text-gray-100 border border-gray-700 px-2 py-2"
                          rows="3"></textarea>
                @error('deskripsi') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end gap-6">
                <button wire:click="endStream"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md text-sm font-semibold">
                    End Stream
                </button>
                <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md">
                    Simpan
                </button>
            </div>
        </form>
        
    </div>

    {{-- Panel Livestreaming + Chat --}}
    <div class="lg:col-span-3 bg-gray-900 rounded-md shadow-md overflow-hidden">
    @if($videoAktif)
        <div class="w-full h-[500px] text-white"> {{-- custom tinggi 500px --}}
            <iframe src="{{ $videoAktif->streaming_url }}" 
                    class="w-full h-full text-white" 
                    frameborder="0" 
                    allowfullscreen>
            </iframe>
        </div>
        <div class="p-4">
            <h2 class="text-xl font-bold text-gray-100">{{ $videoAktif->judul_video }}</h2>
            <p class="text-sm text-gray-400">Pelajaran: {{ $videoAktif->pelajaran->nama_pelajaran }}</p>
            <p class="text-sm text-gray-300 mt-2">{{ $videoAktif->deskripsi }}</p>
        </div>
    @else
        <div class="p-6 text-center text-gray-400 italic">
            Belum ada livestreaming aktif.
        </div>
    @endif
</div>

</div>
