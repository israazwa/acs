<div>
    {{-- Do your work, then step back. --}}
    @livewire('components.admin.home')
    <div class="flex flex-col md:flex-row gap-6">
        <!-- Kolom kiri -->
        <div class="w-full md:w-1/2">
            @livewire('components.admin.pengumuman')
        </div>

        <!-- Kolom kanan -->
        <div class="w-full md:w-1/2">
            
        </div>
    </div>
</div>
