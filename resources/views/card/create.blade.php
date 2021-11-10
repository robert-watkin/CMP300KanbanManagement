<x-dashboard-layout>
    <x-slot name="slot">

        <div class="flex flex-col h-full p-2">

            <div class="max-w-4xl w-full bg-white rounded-lg relative shadow-lg mx-auto my-auto p-2">
                <form action="{{ route('card.store') }}" method="post">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}

                    <h1 class="text-lg">New Card</h1>

                    <div class="px-4">
                        <!-- Title -->
                        <div class="my-2 w-full">
                            <x-jet-label for="title" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Title') }}" />
                            <x-jet-input value="" name="title" id="title" type="text" class="w-full" wire:model.defer="title" autocomplete="title" />
                            <x-jet-input-error for="title" class="mt-2 ml-16" />
                        </div>

                        <!-- Description -->
                        <div class="my-2">
                            <x-jet-label for="description" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Description') }}" />
                            <textarea rows="3" name="description" id="description" type="text" class="w-full overflow-y-hiden resize-none border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="description" autocomplete="title"></textarea>
                            <x-jet-input-error for="description" class="mt-2 ml-16" />
                        </div>

                        <!-- Assigned -->
                        <div>
                            <livewire:card-assignment :board="$board" />
                        </div>

                        <!-- Checklist component? -->
                        <div>
                            <livewire:checklist />
                        </div>

                        <!-- Deadline  -->
                        <div class="my-2">
                            <x-jet-label for="deadline" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Deadline') }}" />
                            <x-date-picker wire:model="deadline" id="deadline" />
                            <x-jet-input-error for="deadline" class="mt-2 ml-16" />
                        </div>
                    </div>

                    <div class="flex flex-row justify-end mt-4">
                        <x-jet-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full" type="submit">
                            {{ __('Create') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            import flatpckr from 'flatpickr';

            // Maybe add conditions on when to run this
            flatpckr('#datepicker');
        </script>
    </x-slot>
</x-dashboard-layout>