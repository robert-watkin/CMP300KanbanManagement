<div class="my-2">
    <x-jet-label for="Checklist" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Checklist') }}" />
    <div class=" pl-0 pr-48">

        @if(isset($checklist))
        @php $counter = 0; @endphp
        @foreach($checklist as $key => $checklistitem)

        <hr />
        <div class="flex flex-row justify-between my-1">
            <div class="flex flex-row">
                <p class="ml-4">•</p>
                <input wire:model.lazy="checklist.{{ $key }}.0" class="ml-2" />
            </div>
            <div class="flex flex-row">
                <input wire:model="checklist.{{ $key }}.1" class="pr-4 mr-4 my-auto rounded-md" type="checkbox" />
                <div type="button" wire:click="removeItem({{ $key }})" class="cursor-pointer my-auto ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </div>

        @php $counter++; @endphp
        @endforeach
        @endif

        <hr />
        <div class="mt-2">
            <a wire:click="addItem" wire:loading.attr="disabled" class="bg-gray-100 cursor-pointer hover:bg-gray-400 text-gray-800 py-1 pl-1 pr-2 border-2 border-r-2 rounded-full inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span>Add Item</span>
            </a>
        </div>
    </div>

    <x-jet-input-error for="Checklist" class="mt-2 ml-16" />

    <input type="hidden" name="checklist" id="checklist" value="{{ json_encode($checklist) }}">
</div>