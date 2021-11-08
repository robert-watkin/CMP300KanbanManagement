<div>
    <div class="flex flex-row">
        <div class="flex text-xl justify-center my-2 px-0">
            <input class="w-full ml-6 text-center text-lg font-bold bg-gray-100 border-0" value="{{ $bucket->title }}" type="text" name="title" id="title" wire:model.lazy="bucketTitle" wire:change="updateBucket" />
        </div>
        <div type="button" wire:click="deleteBucket" class="cursor-pointer mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>

    @foreach($bucket->cards()->get() as $card)
    <div>
        <livewire:card :card="$card" :key="$card->id" />
    </div>
    @endforeach

    <div class="flex justify-center">
        <button wire:click="newCard" wire:loading.attr="disabled" class="bg-gray-100 hover:bg-gray-400 text-gray-800 py-1 pl-1 pr-2 border-2 border-r-2 rounded-full inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>New Card</span>
        </button>
    </div>
</div>