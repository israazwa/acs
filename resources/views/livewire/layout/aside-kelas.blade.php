<div>
    
<div>
    @php
    $user = Auth::user();
    $sekolah = DB::table('sekolahs')
        ->where('kode_unik', $user->kode_unik)
        ->value('nama_sekolah') ?? 'null';
    $nama = Auth::user()->name;
    @endphp

    {{-- In work, do what you enjoy. --}}
    <div x-data="{ sidebarOpen: false }" class="">
        <!-- BACKDROP MOBILE -->
        <div 
            class="fixed inset-0 bg-black bg-opacity-40 z-30 lg:hidden"
            x-show="sidebarOpen"
            x-transition.opacity
            @click="sidebarOpen = false"
        ></div>

        <!-- SIDEBAR -->
        <aside 
            class="fixed inset-y-0 left-0 w-64 bg-gray-900 text-gray-200 z-40 transform
                lg:translate-x-0 transition-transform duration-300"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <!-- Logo -->
            <div class="h-16 flex items-center px-6 mt-5  border-gray-700">
                <p>
                <span class="text-xl font-bold">Admin</span> <br>
                <span class="text-sm text-gray-500 uppercase">{{ $sekolah }}</span>
                </p>
            </div>

            <!-- Menu -->
            <nav class="flex-1 overflow-y-auto py-4">
                <ul class="space-y-1">
                    <li>
                        <div class="items-center text-center text-indigo-300 font-mono px-6 py-2">
                            <span id="clock" class=""></span>
                        </div>
                    </li>
                    
                    <li>
                        <a wire:navigate href="/kelas" class="flex items-center px-6 py-3 hover:bg-gray-800">
                            <i class="fas fa-home w-6"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Produk Dropdown -->
                    <li x-data="{ openProduk: false }" class="list-none">
                        <button 
                            class="w-full flex items-center justify-between px-6 py-3 hover:bg-gray-800"
                            @click="openProduk = !openProduk"
                            :aria-expanded="openProduk"
                        >
                            <span class="flex items-center gap-2">
                                <i class="fas fa-box-open w-6"></i>Video 
                            </span>

                            <!-- Penanda dropdown -->
                            <svg class="w-4 h-4 transform transition-transform duration-300"
                                :class="{ 'rotate-180': openProduk }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <ul 
                            x-show="openProduk"
                            x-collapse
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="pl-12 space-y-1 bg-gray-900/80"
                        >
                            <li><a wire:navigate href="/livestreaming" class="block py-2 text-gray-200 hover:text-white">Live Streaming</a></li>
                            <li><a wire:navigate href="/admin/posttest" class="block py-2 text-gray-200 hover:text-white">Recorded Stream</a></li>
                        </ul>
                    </li>
                    {{-- <li x-data="{ openUser: false }" class="list-none">
                        <button 
                            class="w-full flex items-center justify-between px-6 py-3 hover:bg-gray-800"
                            @click="openUser = !openUser"
                            :aria-expanded="openUser"
                        >
                            <span class="flex items-center gap-2">
                                <i class="fas fa-users w-6"></i> Kelas
                            </span>

                            <!-- Penanda dropdown -->
                            <svg class="w-4 h-4 transform transition-transform duration-300"
                                :class="{ 'rotate-180': openUser }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown User dengan animasi -->
                        <ul 
                            x-show="openUser"
                            x-collapse
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="pl-12 space-y-1 bg-gray-900/80"
                        >
                            <li>
                                <a wire:navigate href="/admin/managementUsers" class="block py-2 text-gray-200 hover:text-white">
                                    Manajemen User
                                </a>
                            </li>
                            <li>
                                <a wire:navigate href="/admin/chat/control" class="block py-2 text-gray-200 hover:text-white">
                                    Control Chat
                                </a>
                            </li>
                        </ul>
                        <li> --}}
                         <a href="/home" class="flex items-center px-6 py-3 hover:bg-orange-800">
                            <i class="fas fa-home w-6"></i>
                            <span class="ml-2">Kembali</span>
                        </a>
                    </li>
                       <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="flex items-center px-6 py-3 hover:bg-red-500 hover:text-white text-red-500">
                                <i class="fas fa-sign-out-alt w-6"></i>
                                <span class="ml-2">Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- HEADER -->
        <header class="h-16 bg-gray-900 flex items-center px-4 lg:px-6 justify-between lg:ml-64">
            <div class="flex items-center gap-3">
                <!-- Hamburger -->
                <button 
                    class="lg:hidden flex items-center justify-center text-white w-10 h-10 rounded-md bg-gray-900 hover:bg-gray-300"
                    @click="sidebarOpen = true"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <h1 class="font-semibold text-md text-white flex items-center justify-between">
                    <span id="greeting" class=" font-semibold"></span>
                    <span>,</span>
                    <span class=" mx-1 uppercase"> <?= $nama; ?></span>
                    
                </h1>

                <script>
                    function updateClockAndGreeting() {
                        const now = new Date();
                        const hours   = now.getHours();
                        const minutes = String(now.getMinutes()).padStart(2, '0');
                        const seconds = String(now.getSeconds()).padStart(2, '0');
                        const timeString = `${String(hours).padStart(2, '0')}:${minutes}:${seconds}`;

                        // Tentukan greeting berdasarkan jam
                        let greeting = '';
                        if (hours >= 5 && hours < 11) {
                            greeting = 'Selamat pagi';
                        } else if (hours >= 11 && hours < 15) {
                            greeting = 'Selamat siang';
                        } else if (hours >= 15 && hours < 18) {
                            greeting = 'Selamat sore';
                        } else {
                            greeting = 'Selamat malam';
                        }

                        document.getElementById('clock').textContent = timeString;
                        document.getElementById('greeting').textContent = greeting;
                    }

                    setInterval(updateClockAndGreeting, 1000);
                    updateClockAndGreeting();
                </script>
            </div>
        </header>
    </div>
</div>


</div>
