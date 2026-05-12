<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    @include('livewire.welcome.navigation')
    <section class="bg-gradient-to-b from-orange-50 to-orange-100/30 bg-gray-900 py-16 min-h-screen">
        <div class="container mx-auto px-6 lg:px-12 mt-16">
            <div class="bg-gradient-to-b from-orange-50 to-orange-200 max-w-4xl mx-auto rounded-xl shadow-2xl p-10 flex flex-col md:flex-row items-center md:items-start gap-8">

                <!-- Logo di kiri -->
                <div class="flex justify-center items-center w-full md:w-1/3">
                    <img src="{{ asset('logo.png') }}" alt="Logo"
                        class="w-24 h-auto md:w-32 mt-10 md:mt-20">
                </div>

                <!-- Form di kanan -->
                <div class="w-full md:w-2/3">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form wire:submit="login">
                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full"
                                        type="email" name="email" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                                        type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 gap-2">
                            <!-- Remember Me -->
                            <label for="remember" class="inline-flex items-center">
                                <input wire:model="form.remember" id="remember" type="checkbox"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>

                            <!-- Forgot Password -->
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" wire:navigate
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>



                        <!-- Actions -->
                        <div class="flex items-center justify-end mt-4">
                            
                            <div class="flex items-center justify-center mt-6 gap-3">
                                <!-- Tombol login biasa -->
                                <x-primary-button>
                                    {{ __('Log in') }}
                                </x-primary-button>

                                <!-- Tombol login dengan Google -->
                                <a href="#"
                                class="relative overflow-hidden flex items-center justify-center gap-2 px-4 py-3 border border-gray-300 rounded-md shadow-sm bg-white hover:bg-indigo-50 transition duration-300 ease-in-out group">
                                    <img src="{{ asset('google.png') }}" alt="Google" class="w-5 h-5">
                                    <span class="text-sm font-medium text-gray-700">Login dengan Google</span>

                                    <!-- Shine effect -->
                                    <span class="absolute inset-0 bg-gradient-to-r from-transparent via-white/60 to-transparent 
                                                translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000 ease-in-out"></span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    @include('unlogin.footer')
</div>
