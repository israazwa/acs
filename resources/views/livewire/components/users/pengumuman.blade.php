<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="rounded-xl p-16 text-center mb-8">
        <p class="text-2xl uppercase font-extrabold text-gray-900 tracking-wide mb-3" data-aos="fade-up">
            {{ Auth::user()->sekolah->nama_sekolah ?? 'tidak tersedia' }}
        </p>
        @if(!empty(Auth::user()->sekolah->pengumuman))
            <div class="bg-red-500/40 rounded-md" data-aos="fade-up">
                <p class="uppercase text-lg font-bold bg-red-500 rounded-md text-white py-1 mb-3" data-aos="fade-up" data-aos-delay="400">
                    Pengumuman
                </p>
                <div id="clock" class="text-sm font-mono text-gray-800" data-aos="fade-up" data-aos-delay="600"></div>
                <p class="text-base text-white leading-relaxed font-semibold p-8 bg-gray-800/40 rounded-md" data-aos="fade-up" data-aos-delay="800">
                    {{ Auth::user()->sekolah->pengumuman }}
                </p>
            </div>
        @else
            <div class="bg-gray-700/20 rounded-md" data-aos="fade-up">
                <p class="uppercase text-lg font-bold bg-green-500 rounded-md text-white py-1 mb-3" data-aos="fade-up" data-aos-delay="200">
                    Tidak ada pengumuman
                </p>
            </div>
        @endif
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
