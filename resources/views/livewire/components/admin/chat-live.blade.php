<section class="grid grid-cols-1 md:grid-cols-12 gap-8 p-10 min-h-32">
    <!-- Chat Panel -->
    <div class="md:col-span-8 bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div class="p-3 flex items-center space-x-2 bg-gray-900 border-t border-gray-700">
            <input type="text" wire:model="newMessage" wire:keydown.enter="sendMessage"
                   placeholder="Tulis pesan..."
                   class="flex-1 border border-gray-600 rounded-md px-2 py-1 text-sm bg-gray-800 text-gray-200 focus:ring-1 focus:ring-orange-500 focus:outline-none">
            <button wire:click="sendMessage"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 text-sm rounded-md">
                Kirim
            </button>
        </div>
        <div wire:poll.3s="loadChat" 
             class="flex-1 max-h-[10rem] overflow-y-auto space-y-2 p-3 border-b border-gray-700 bg-gray-800">
            @forelse($chatMessages as $chat)
                @if($chat->role_pengirim === 'admin' || $chat->role_pengirim === 'guru')
                    <div class="flex justify-start">
                        <div class="bg-yellow-200 border-l-4 border-yellow-500 rounded-md p-2 max-w-sm relative shadow-sm">
                            <p class="text-xs font-semibold text-yellow-800">
                                {{ $chat->user->name }} ({{ ucfirst($chat->role_pengirim) }})
                            </p>
                            <p class="text-sm text-gray-900 leading-snug">{{ $chat->pesan }}</p>
                            <span class="text-[10px] text-gray-600">{{ $chat->created_at->diffForHumans() }}</span>

                            @if(in_array(Auth::user()->role, ['admin','guru']))
                                <button wire:click="togglePin({{ $chat->id }})"
                                        class="absolute top-1 right-1 text-[10px] px-2 py-0.5 rounded bg-orange-500 text-white hover:bg-orange-600">
                                    {{ $chat->is_pinned ? 'Unpin' : 'Pin' }}
                                </button>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="flex {{ $chat->user_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="bg-gray-700 rounded-md shadow-sm p-2 max-w-xs">
                            <p class="text-xs font-semibold text-gray-200">{{ $chat->user->name }}</p>
                            <p class="text-sm text-gray-300 leading-snug">{{ $chat->pesan }}</p>
                            <span class="text-[10px] text-gray-400">{{ $chat->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-gray-400 italic text-sm">Belum ada pesan.</p>
            @endforelse
        </div>
    </div>

    <!-- Panel kanan -->

    <div class="md:col-span-4 bg-gray-800 text-white rounded-lg p-6">
       <div x-data="{ sending: false, message: '' }"
        x-on:notify.window="message = $event.detail.message; sending = false; setTimeout(() => message = '', 3000)"
        x-on:reset-sending.window="sending = false"
        class="flex flex-col items-center space-y-4">

        <!-- Tombol Kirim -->
        <button @click="sending = true; $wire.sendNotificationEmail()"
                class="px-6 py-2 bg-orange-600 text-white font-semibold rounded-lg shadow 
                    hover:bg-orange-700 hover:shadow-lg transform hover:scale-105 
                    transition-all duration-300 ease-in-out">
            <template x-if="!sending">
                <span>Kirim Notifikasi</span>
            </template>
            <template x-if="sending">
                <span class="flex items-center gap-2">
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    Mengirim...
                </span>
            </template>
        </button>

        <!-- Toast Notification -->
        <template x-if="message">
            <div x-transition
                class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg">
                <span x-text="message"></span>
            </div>
        </template>
    </div>

    </div>

    </div>
</section>
