<div>
    {{-- Be like water. --}}
    <div class="bg-gray-800 min-h-screen px-6">
        <div class="max-w-3xl mx-auto bg-gray-900 rounded-xl shadow-lg overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-gray-700 to-gray-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white">Pengumuman Sekolah</h2>
            </div>

            {{-- Body --}}
            <div class="p-6">
                @if (session()->has('success'))
                    <div class="bg-green-600 text-white px-4 py-2 rounded mb-4 shadow">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="save" class="space-y-5">
                    <div>
                        <label class="block text-gray-300 font-semibold mb-2">Isi Pengumuman</label>
                            <textarea wire:model.defer="pengumuman" rows="4"
                                    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-gray-100 
                                            focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    placeholder="Masukkan isi pengumuman"></textarea>
                            @error('pengumuman') 
                                <span class="text-red-400 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>

                    <div class="flex justify-end gap-3 mt-6">
                        @if($pengumuman)
                            {{-- Tombol Hapus --}}
                            <button type="button" wire:click="clear"
                                    class="px-8 py-1 text-lg font-semibold text-yellow-400 border bg-yellow-200/20 border-yellow-400 rounded-lg hover:bg-orange-100 hover:border-orange-500 hover:text-orange-500 hover:shadow-2xl
                                    transition transform hover:scale-105 disabled:opacity-50"
                                    wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="clear"> Hapus</span>
                                <span wire:loading wire:target="clear" class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 01-8 8z"></path>
                                    </svg>
                                    Menghapus...
                                </span>
                            </button>

                            {{-- Tombol Kirim Email --}}
                            <button type="button" wire:click="sendEmail"
                                    class="px-8 py-1 text-lg font-semibold text-indigo-200 border border-indigo-600 bg-indigo-300/20 rounded-lg hover:bg-red-100 hover:border-red-500 hover:text-red-500 hover:shadow-2xl
                                    transition transform hover:scale-105 disabled:opacity-50"
                                    wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="sendEmail"> Kirim Email</span>
                                <span wire:loading wire:target="sendEmail" class="flex items-center gap-2">
                                    <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 01-8 8z"></path>
                                    </svg>
                                    Mengirim...
                                </span>
                            </button>
                        @endif

                        {{-- Tombol Simpan --}}
                        <button type="submit"
                                class="px-8 py-1 text-lg font-semibold text-orange-600 border border-orange-600 rounded-lg hover:bg-green-100 hover:border-green-500 hover:text-green-500 hover:shadow-2xl
                                    transition transform hover:scale-105 disabled:opacity-50"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="save"> Simpan</span>
                            <span wire:loading wire:target="save" class="flex items-center gap-8">
                                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 01-8 8z"></path>
                                </svg>
                                Menyimpan...
                            </span>
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

</div>
