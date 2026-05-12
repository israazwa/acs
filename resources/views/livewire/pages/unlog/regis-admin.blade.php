<div class="">
    @include('livewire.welcome.navigation')
    <section class="bg-gradient-to-b from-gray-100 to-orange-100 py-16">

        <div class="container mx-auto px-6 lg:px-12">
            <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-2xl p-10">
                <!-- Overlay pesan sukses/error -->
                @if (session()->has('success') || session()->has('error'))
                <div 
                    x-data="{ show: true, countdown: 5 }"
                    x-init="
                        if (show) {
                            let interval = setInterval(() => {
                                if (countdown > 0) {
                                    countdown--;
                                } else {
                                    show = false;
                                    clearInterval(interval);
                                }
                            }, 1000);
                        }
                    "
                    x-show="show"
                    x-transition.opacity
                    class="fixed inset-0 flex items-center justify-center z-50"
                >
                    @if (session()->has('success'))
                        <div class="relative bg-green-100 border border-green-400 text-green-700 px-12 py-6 rounded-lg shadow-lg w-96 text-center">
                            <span class="block font-semibold">{{ session('success') }}</span>
                            <span class="text-sm text-green-600">Menutup otomatis dalam <span x-text="countdown"></span> detik</span>
                            <button @click="show = false" class="absolute top-2 right-2 text-green-700 hover:text-green-900">
                                ✕
                            </button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="relative bg-red-100 border border-red-400 text-red-700 px-12 py-6 rounded-lg shadow-lg w-96 text-center">
                            <span class="block font-semibold">{{ session('error') }}</span>
                            <span class="text-sm text-red-600">Menutup otomatis dalam <span x-text="countdown"></span> detik</span>
                            <button @click="show = false" class="absolute top-2 right-2 text-red-700 hover:text-red-900">
                                ✕
                            </button>
                        </div>
                    @endif
                </div>
                @endif

                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                    Registrasi Admin Sekolah
                </h2>

                <!-- Livewire form -->
                <form wire:submit.prevent="submit" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap Dengan Gelar</label>
                        <input id="name" type="text" wire:model="name"
                            class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" wire:model="email"
                            class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" wire:model="password"
                            class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" wire:model="password_confirmation"
                            class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <!-- Nama Sekolah -->
                    <div class="md:col-span-2">
                        <label for="sekolah" class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                        <input id="sekolah" type="text" wire:model="sekolah"
                            class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('sekolah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Alamat Sekolah -->
                    <div class="md:col-span-2">
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Sekolah</label>
                        <textarea id="alamat" rows="3" wire:model="alamat"
                            class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Upload KTP -->
                    <div class="md:col-span-2"
                    x-data="{ fileName: '', previewUrl: '' }"
                    @dragover.prevent
                    @drop.prevent="
                        const droppedFile = $event.dataTransfer.files[0];
                        if(droppedFile && droppedFile.type.match('image.*')){
                            fileName = droppedFile.name;
                            previewUrl = URL.createObjectURL(droppedFile);
                            $refs.ktp.files = $event.dataTransfer.files;
                            $dispatch('input', $event.dataTransfer.files[0]); // trigger Livewire binding
                        }
                    ">
                    <label for="ktp" class="block text-sm font-medium text-gray-700 mb-2">Upload KTP</label>

                    <!-- Container dengan background preview -->
                    <div class="relative flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed rounded-lg cursor-pointer transition"
                            :style="previewUrl ? 'background-image: url(' + previewUrl + '); background-size: cover; background-position: center;' : ''">

                            <!-- Overlay konten drag & drop -->
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 bg-white/60 rounded-lg w-full h-full">
                                <svg class="w-10 h-10 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0l-4 4m4-4l4 4M17 8v12m0 0l-4-4m4 4l4-4" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-600">
                                    <span class="font-semibold">Klik untuk upload</span> atau drag & drop
                                </p>
                                <p class="text-xs text-gray-500">PNG, JPG (max 2MB)</p>
                            </div>

                            <!-- Input file hidden -->
                            <input id="ktp" type="file" wire:model="ktp" accept="image/*" class="hidden" x-ref="ktp"
                                @change="
                                        if($refs.ktp.files[0]){
                                            fileName = $refs.ktp.files[0].name;
                                            previewUrl = URL.createObjectURL($refs.ktp.files[0]);
                                        }
                                " />
                        </label>
                    </div>

                    <!-- Nama file -->
                    <template x-if="fileName">
                        <p class="mt-3 text-sm text-gray-700">File dipilih: <span class="font-semibold" x-text="fileName"></span></p>
                    </template>
                </div>


                    <!-- Tombol Submit -->
                    <div class="md:col-span-2 flex justify-center">
                        <button type="submit"
                            class="px-8 py-3 bg-indigo-600 text-white font-semibold rounded-md shadow hover:bg-indigo-700 transition duration-300 ease-in-out">
                            Registrasi Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
    </section>
</div>