<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="bg-gradient-to-b from-gray-50 to-gray-200">
        @include('livewire.components.users.hero')
    </div>
    <div class="bg-gradient-to-b from-gray-200 to-orange-300">
        @include('livewire.components.users.feature')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            @include('livewire.components.users.pengumuman')
            @include('livewire.components.users.tabel-kelas')    
        </div>
    </div>
    @include('unlogin.footer')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>


</div>
