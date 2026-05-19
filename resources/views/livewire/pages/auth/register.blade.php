<?php

use App\Models\User;
use App\Models\Sekolah;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $kode_unik = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'kode_unik' => ['required', 'string'],
        ]);

        // cek kode unik sekolah
        $sekolah = Sekolah::where('kode_unik', $validated['kode_unik'])->first();

        if (!$sekolah) {
            $this->addError('kode_unik', 'Kode unik tidak valid.');
            return;
        }

        // hash password
        $validated['password'] = Hash::make($validated['password']);

        // tambahkan field tambahan
        $validated['sekolah_id'] = $sekolah->id;
        $validated['role'] = 'siswa'; 
        // buat user baru
        $user = User::create($validated);

        event(new Registered($user));
        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
?>
<div class="main">
    @include('livewire.welcome.navigation')
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-gray-100 to-orange-300 px-4">
        <div class="w-full max-w-md sm:max-w-lg md:max-w-xl bg-white rounded-2xl shadow-xl p-8">
            
            <!-- Judul -->
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 text-center mb-6">
                Register Akun
            </h2>

            <!-- Form -->
            <form wire:submit.prevent="register" class="space-y-5">
                
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input wire:model="name" id="name" type="text"
                        class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500"
                        placeholder="Masukkan nama lengkap" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" type="email"
                        class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500"
                        placeholder="contoh@email.com" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input wire:model="password" id="password" type="password"
                        class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500"
                        placeholder="••••••••" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input wire:model="password_confirmation" id="password_confirmation" type="password"
                        class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500"
                        placeholder="Ulangi password" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Kode Unik -->
                <div>
                    <x-input-label for="kode_unik" :value="__('Kode Unik')" />
                    <x-text-input wire:model="kode_unik" id="kode_unik" type="text"
                        class="w-full rounded-lg border-gray-300 focus:border-orange-500 focus:ring-orange-500"
                        placeholder="Masukkan kode unik sekolah" required />
                    <x-input-error :messages="$errors->get('kode_unik')" class="mt-2" />
                </div>

                <!-- Action -->
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mt-6">
                    <a href="{{ route('login') }}" wire:navigate
                    class="text-sm text-blue-600 hover:text-orange-600 transition">
                        Sudah punya akun?
                    </a>
                    <x-primary-button 
                        class="w-full sm:w-auto bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg shadow">
                        Register
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    @include('unlogin.footer')
</div>