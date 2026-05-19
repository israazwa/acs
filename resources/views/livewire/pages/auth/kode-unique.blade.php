<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <div class="flex items-center justify-center min-h-screen bg-gradient-to-b from-orange-100 to-orange-300 px-6">
    <div class="bg-white rounded-xl shadow-lg p-8 w-full 
                max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl">

        <!-- Judul -->
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">
            Masukkan Kode Unik
        </h2>

        <!-- Error -->
        @error('kode_unik')
            <div class="bg-red-500 text-white p-3 rounded mb-4 text-sm md:text-base">
                {{ $message }}
            </div>
        @enderror

        <!-- Form -->
        <form wire:submit.prevent="submit" class="space-y-5">
            <div>
                <label for="kode_unik" 
                       class="block text-gray-700 font-semibold mb-2 text-sm md:text-base">
                    Kode Unik
                </label>
                <div class="relative">
                    <!-- Icon -->
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <img src="{{ asset('key.svg') }}" alt="Key Icon" class="h-5 w-5 text-gray-400">
                    </span>

                    <input type="text" id="kode_unik" wire:model="kode_unik"
                        class="w-full pl-10 pr-3 py-2 rounded-lg border border-gray-300 
                                bg-gray-50 text-gray-800 
                                focus:outline-none focus:ring-2 focus:ring-orange-400
                                text-sm md:text-base"
                        placeholder="Masukkan kode unik sekolah" required>
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition
                           text-sm md:text-base shadow-md">
                Simpan & Lanjutkan
            </button>
        </form>
    </div>
</div>


</div>
