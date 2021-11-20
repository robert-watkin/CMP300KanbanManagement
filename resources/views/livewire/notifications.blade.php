<x-jet-dropdown align="left" style="bottom:100%;" width="48">
    <x-slot name="trigger">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <button class="flex text-sm border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        </button>
        @else
        <span class="inline-flex rounded-md mt-3">
            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                @if (count($invitations) == 0)
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                @else
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 animate-bounce" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg> -->
                @endif
            </button>
        </span>
        @endif
    </x-slot>

    <x-slot name="content">
        <div>
            <div class="p-1">
                <h2 class="text-sm">Invitations</h2>
                @if (count($invitations) == 0)
                <hr />
                <h3>No Invitations</h3>
                @else
                @foreach($invitations as $invitation)
                <hr />
                <div class="flex flex-row justify-between p-2">
                    <p class="flex flex-grow">{{$invitation->board->title}}</p>

                    <div class="flex flex-row justify-end" wire:loading.remove>
                        <button wire:click="acceptInvitation({{ $invitation }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-current text-gray-600 hover:text-purple-600" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>

                        <button wire:click="declineInvitation({{ $invitation }})">
                            <svg wire:click="declineInvitation({{ $invitation }})" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 stroke-current text-gray-600 hover:text-purple-600" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div wire:loading wire:target="acceptInvitation, declineInvitation" class="animate-spin rounded-full h-4 w-4 border-t-2 mx-auto border-b-2 border-purple-500"></div>
                </div>
                @endforeach
                @endif

            </div>
        </div>
    </x-slot>
</x-jet-dropdown>