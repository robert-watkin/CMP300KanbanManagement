<x-dashboard-layout>
    <x-slot name="slot">
        <div class="flex h-full p-2">
            <div class="max-w-4xl w-full bg-white rounded-lg overflow-hidden shadow-lg mx-auto my-auto p-2">
                <h1 class="text-lg">New Board</h1>

                <!-- Title -->
                <div class="flex flex-row my-2">
                    <x-jet-label for="title" class="flex-none ml-2 mx-4 my-2 text-lg" value="{{ __('Title') }}" />
                    <x-jet-input id="title" type="text" class="flex-grow" wire:model.defer="state.title" autocomplete="title" />
                    <x-jet-input-error for="title" class="mt-2" />
                </div>

                <div>
                    <div class="flex flex-row justify-between">
                        <x-jet-label for="members" class="flex-none ml-2 mx-4 my-2 text-lg" value="{{ __('Members') }}" />

                    </div>
                    <table class="bg-gray-100 border-2 rounded-lg w-full">
                        <thead class="bg-blueGray-50 rounded-full">
                            <tr>
                                <th class="px-6 align-middle  py-3 text-xs uppercase whitespace-nowrap font-semibold text-left">Name</th>
                                <th class="px-6 align-middle  py-3 text-xs uppercase whitespace-nowrap font-semibold text-left">Status</th>
                                <th class="px-6 align-middle  py-3 text-xs uppercase whitespace-nowrap font-semibold text-left">Role</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 h-80">

                        </tbody>
                    </table>
                    <div>
                    </div>
                </div>
    </x-slot>
</x-dashboard-layout>