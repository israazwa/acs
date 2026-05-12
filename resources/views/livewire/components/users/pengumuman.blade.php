<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="rounded-xl p-20 text-center mb-8">
            <p class="text-2xl uppercase font-extrabold text-gray-900 tracking-wide mb-3">
                {{ Auth::user()->sekolah->nama_sekolah ?? 'tidak tersedia' }}
            </p>
            <p class="uppercase text-lg font-bold bg-red-500 rounded-md text-white py-1 mb-3">Pengumuman</p>
            <div id="clock" class="text-sm font-mono text-gray-800 mb-2"></div>
            <p class="text-base text-gray-700 leading-relaxed">
                {{ Auth::user()->sekolah->pengumuman ?? 'tidak tersedia' }}
            </p>
    </div>    
    <script>
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                timeZone: 'Asia/Jakarta',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('clock').textContent = timeString + ' WIB';
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>

</div>
