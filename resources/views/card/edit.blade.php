<x-dashboard-layout>
    <x-slot name="slot">
        <div class="flex flex-col h-full p-2">

            <div class="max-w-4xl w-full bg-white rounded-lg relative shadow-lg mx-auto my-auto p-2">
                <form action="{{ route('card.update', ['card' => $card]) }}" method="post">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}

                    <h1 class="text-lg">Task Card</h1>

                    <div class="my-2">
                        <div class="flex flex-row ">
                            <x-jet-label for="title" class="flex-none ml-2 mx-4 my-2 text-lg" value="{{ __('Title') }}" />
                            <x-jet-input value="{{ $card->title }}" name="title" id="title" type="text" class="flex-grow" wire:model="title" autocomplete="title" />
                        </div>
                        <x-jet-input-error for="title" class="mt-2 ml-16" />
                    </div>


                    <div class=" flex flex-row justify-end mt-4">
                        <x-jet-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full" type="submit">
                            {{ __('Save') }}
                        </x-jet-button>
                    </div>
                </form>

                <form class="absolute left-2 bottom-2" action="{{ route('card.destroy' , $card->id)}}" method="POST">
                    <input name="_method" type="hidden" value="DELETE">
                    {{ csrf_field() }}

                    <x-jet-button class="bg-red-500 hover:bg-red-700 text-white font-bold rounded-full" type="submit">
                        {{ __('Delete') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </x-slot>
</x-dashboard-layout>