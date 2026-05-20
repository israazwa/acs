<div x-data="{ message: '', confirmAction: null, confirmUser: null }"
     x-on:notify.window="message = $event.detail.message; setTimeout(() => message = '', 5000)"
     class="relative">

    <!-- Notifikasi di atas tabel -->
    <template x-if="message">
        <div x-transition.opacity
             class="mb-4 bg-orange-600/90 text-white px-6 py-3 rounded-lg shadow-md flex items-center gap-2">
            <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7"></path>
            </svg>
            <span x-text="message" class="font-medium"></span>
        </div>
    </template>

    <!-- Tabel pengguna -->
    <div class="bg-gray-900 p-6 rounded-xl text-white" wire:poll.1s>
        <h2 class="text-xl font-bold mb-4">Daftar Pengguna</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Role</th>
                        <th class="px-4 py-2 text-center">Created</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-800 transition">
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->role }}</td>
                            <td class="px-4 py-2">{{ $user->created_at->format('l, Y-m-d') }} <span><br>{{ $user->created_at->format('h:i') }}</span> </td>
                            <td class="px-4 py-2 flex justify-center gap-3">
                                <button 
                                    @click="confirmAction = 'kick'; confirmUser = {{ $user->id }}"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-sm shadow-md transition">
                                    Tendang
                                </button>
                                <button 
                                    @click="confirmAction = 'resetExam'; confirmUser = {{ $user->id }}"
                                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-sm shadow-md transition">
                                    Reset Ujian
                                </button>

                                @if($user->id !== auth()->id())
                                    <button 
                                        @click="confirmAction = 'toggleRole'; confirmUser = {{ $user->id }}"
                                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-sm shadow-md transition">
                                        Ubah Role
                                    </button>
                                @else
                                    <div class="px-4 py-1 font-semibold bg-gray-600 hover:bg-gray-700 rounded-sm shadow-md transition">    
                                        <p class="text-xs">Ubah Role <br>Tidak Tersedia</p>                              
                                    </div>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="mt-4 px-10">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div x-show="confirmAction" 
         class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
         x-transition>
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Konfirmasi Aksi</h3>
            <p class="text-gray-600 mb-6">
                Apakah Anda yakin ingin 
                <span x-text="
                    confirmAction === 'kick' ? 'menendang user ini' : 
                    (confirmAction === 'resetExam' ? 'mereset ujian user ini' : 'mengubah role user ini')
                "></span>?
            </p>
            <div class="flex justify-end gap-3">
                <button @click="confirmAction = null; confirmUser = null"
                        class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md">
                    Batal
                </button>
                <button @click="$wire[confirmAction](confirmUser); confirmAction = null; confirmUser = null"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>
</div>
