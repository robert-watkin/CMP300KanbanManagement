<x-dashboard-layout>
    <x-slot name="slot">
        <div class="flex flex-col h-full p-2">

            <div class="max-w-4xl w-full bg-white rounded-lg  shadow-lg mx-auto my-auto p-2">
                <form action="{{ route('board.store') }}" method="post">
                    <h1 class="text-lg">New Board</h1>

                    <!-- Title -->
                    <div class="my-2">
                        <div class="flex flex-row ">
                            <x-jet-label for="title" class="flex-none ml-2 mx-4 my-2 text-lg" value="{{ __('Title') }}" />
                            <x-jet-input name="title" id="title" type="text" class="flex-grow" wire:model="title" autocomplete="title" />
                        </div>
                        <x-jet-input-error for="title" class="mt-2 ml-16" />
                    </div>

                    <div>
                        <livewire:add-member />
                    </div>

                    <div class=" flex flex-row justify-end mt-4">
                        <x-jet-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full" type="submit">
                            {{ __('Create') }}
                        </x-jet-button>
                    </div>


                </form>
            </div>
        </div>
    </x-slot>
</x-dashboard-layout>