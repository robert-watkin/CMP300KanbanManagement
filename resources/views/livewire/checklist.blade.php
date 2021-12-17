<div class="my-2">
    <x-jet-label for="Checklist" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Checklist') }}" />
    <div class=" pl-0">

        @if (auth()->user()->role != "Admin" && isset($card))
        @php
        $link = auth()->user()->boards()->where(['board_id' => $card->bucket->board->id])->first();
        @endphp
        @endif

        @if(isset($checklist))
        @php $counter = 0; @endphp
        @foreach($checklist as $key => $checklistitem)

        <hr />
        <div class="flex flex-row justify-between my-1">
            <div class="flex flex-row flex-grow">
                <p class="ml-4">•</p>
                <input wire:model.lazy="checklist.{{ $key }}.0" class="mx-2 w-full" />
            </div>
            <div class="flex flex-row">

                @if (auth()->user()->role == "Admin")
                <input wire:model="checklist.{{ $key }}.1" class="pr-4 mr-4 my-auto rounded-md" type="checkbox" />

                <div type="button" wire:click="removeItem({{ $key }})" class="cursor-pointer my-auto ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                @else
                @if (!isset($link) || $link->role != "Viewer")
                <input wire:model="checklist.{{ $key }}.1" class="pr-4 mr-4 my-auto rounded-md" type="checkbox" />

                <div type="button" wire:click="removeItem({{ $key }})" class="cursor-pointer my-auto ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                @else
                <input disabled wire:model="checklist.{{ $key }}.1" class="pr-4 mr-4 my-auto rounded-md" type="checkbox" />
                @endif
                @endif
            </div>
        </div>

        @php $counter++; @endphp
        @endforeach
        @endif

        <hr />

        @if (auth()->user()->role == "Admin")
        <div class="mt-2">
            <a wire:click="addItem" wire:loading.attr="disabled" class="bg-gray-100 cursor-pointer hover:bg-gray-400 text-gray-800 py-1 pl-1 pr-2 border-2 border-r-2 rounded-full inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add Item</span>
            </a>
        </div>
        @else
        @if (!isset($link) || $link->role != "Viewer")
        <div class="mt-2">
            <a wire:click="addItem" wire:loading.attr="disabled" class="bg-gray-100 cursor-pointer hover:bg-gray-400 text-gray-800 py-1 pl-1 pr-2 border-2 border-r-2 rounded-full inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add Item</span>
            </a>
        </div>
        @endif
        @endif
    </div>

    <x-jet-input-error for="Checklist" class="mt-2 ml-16" />

    <input type="hidden" name="checklist" id="checklist" value="{{ json_encode($checklist) }}">
</div>