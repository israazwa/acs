<section class="grid grid-cols-1 md:grid-cols-12 gap-8 p-10 min-h-32">
    <!-- Chat Panel -->
    <div class="md:col-span-8 bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col">
        <div wire:poll.3s="loadChat" 
             class="flex-1 max-h-[28rem] overflow-y-auto space-y-2 p-3 border-b border-gray-700 bg-gray-800">
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

        <!-- Input pesan -->
        <div class="p-3 flex items-center space-x-2 bg-gray-900 border-t border-gray-700">
            <input type="text" wire:model="newMessage" wire:keydown.enter="sendMessage"
                   placeholder="Tulis pesan..."
                   class="flex-1 border border-gray-600 rounded-md px-2 py-1 text-sm bg-gray-800 text-gray-200 focus:ring-1 focus:ring-orange-500 focus:outline-none">
            <button wire:click="sendMessage"
                    class="bg-orange-500 hover:bg-orange-600 text-white px-3 py-1 text-sm rounded-md">
                Kirim
            </button>
        </div>
    </div>

    <!-- Panel kanan -->
    <div class="md:col-span-4 bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <!-- isi panel kanan -->
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Hic itaque sit assumenda tenetur magnam in enim quas fugit quo vel accusantium ut sapiente expedita nesciunt perferendis doloremque, dolorum fuga sed dolorem eius?
    </div>
</section>
