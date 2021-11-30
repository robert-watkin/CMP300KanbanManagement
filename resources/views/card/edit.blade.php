<x-dashboard-layout>
    <x-slot name="slot">

        <div class="flex flex-col h-full p-2">

            <div class="max-w-4xl w-full bg-white rounded-lg shadow-lg mx-auto my-auto p-2">
                <div class="relative py-2">
                    <form action="{{ route('card.update', ['boardid' => $board->id, 'card' => $card]) }}" method="post">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <h1 class="text-lg">Edit Card</h1>

                        <div class="px-4">
                            <!-- Title -->
                            <div class="my-2 w-full">
                                <x-jet-label for="title" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Title') }}" />
                                <x-jet-input value="{{ $card->title }}" name="title" id="title" type="text" class="w-full" wire:model.defer="title" autocomplete="title" />
                                <x-jet-input-error for="title" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div class="my-2">
                                <x-jet-label for="description" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Description') }}" />
                                <textarea rows="3" value="" name="description" id="description" type="text" class="w-full overflow-y-hiden resize-none border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="description" autocomplete="title">{{ $card->description }}</textarea>
                                <x-jet-input-error for="description" class="mt-2" />
                            </div>

                            <!-- Assigned -->
                            <div>
                                <livewire:card-assignment :card="$card" :board="$board" />
                            </div>

                            <!-- Checklist component? -->
                            <div>
                                <livewire:checklist :card="$card" />
                            </div>

                            <!-- Deadline  -->
                            <div class="my-2">
                                <x-jet-label for="deadline" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Deadline') }}" />
                                <input autocomplete="off" wire:model="deadline" name="deadline" type="text" id="deadline" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" />
                                <x-jet-input-error for="deadline" class="mt-2" />
                            </div>
                        </div>

                        <script>
                            var picker = new Pikaday({
                                field: document.getElementById('deadline'),
                                format: 'YYYY-M-D'
                            });
                            picker.setDate(new Date("{{ $card->deadline}}"));
                        </script>

                        <div class="flex flex-row justify-end mt-4 pr-2">
                            <x-jet-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full" type="submit">
                                {{ __('Save') }}
                            </x-jet-button>
                        </div>
                    </form>

                    <form class="absolute left-2 bottom-2" action="{{ route('card.destroy' , $card->id) }}" method="POST">
                        <input name="_method" type="hidden" value="DELETE">
                        {{ csrf_field() }}

                        <x-jet-button class="bg-red-500 hover:bg-red-700 text-white font-bold rounded-full ml-2" type="submit">
                            {{ __('Delete') }}
                        </x-jet-button>
                    </form>
                </div>

                <div>
                    <livewire:comments :card="$card" />
                </div>
            </div>
        </div>

    </x-slot>
</x-dashboard-layout>