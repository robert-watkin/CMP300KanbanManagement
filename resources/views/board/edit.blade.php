<x-dashboard-layout>
    <x-slot name="slot">
        <div class="flex flex-col h-full p-2">

            <div class="max-w-4xl w-full bg-white rounded-lg relative shadow-lg mx-auto my-auto p-2">
                <form action="{{ route('board.update', ['board' => $board]) }}" method="post">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}

                    <h1 class="text-lg">Board Settings</h1>

                    @php
                    $link = auth()->user()->boards()->where(['board_id' => $board->id])->first();
                    @endphp

                    <!-- Title -->
                    <div class="my-2">
                        <div class="flex flex-row ">
                            <x-jet-label for="title" class="flex-none ml-2 mx-4 my-2 text-lg" value="{{ __('Title') }}" />
                            @if ($link->role == "Admin")
                            <x-jet-input value="{{ $board->title }}" name="title" id="title" type="text" class="flex-grow" wire:model="title" autocomplete="title" />
                            @else
                            <x-jet-input disabled value="{{ $board->title }}" name="title" id="title" type="text" class="flex-grow" wire:model="title" autocomplete="title" />
                            @endif
                        </div>
                        <x-jet-input-error for="title" class="mt-2 ml-16" />
                    </div>

                    <div>
                        <livewire:add-member :board="$board" />
                    </div>

                    @if ($link->role == "Admin")
                    <div class=" flex flex-row justify-end mt-4">
                        <x-jet-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full" type="submit">
                            {{ __('Save') }}
                        </x-jet-button>
                    </div>
                    @endif
                </form>

                @if ($link->role == "Admin")
                <form class="absolute left-2 bottom-2" action="{{ route('board.destroy' , $board->id)}}" method="POST">
                    <input name="_method" type="hidden" value="DELETE">
                    {{ csrf_field() }}

                    <x-jet-button class="bg-red-500 hover:bg-red-700 text-white font-bold rounded-full" type="submit">
                        {{ __('Delete') }}
                    </x-jet-button>
                </form>
                @endif
            </div>
        </div>
    </x-slot>
</x-dashboard-layout>