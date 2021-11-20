<div class="bg-blue-100 mt-2 px-1 pb-2 rounded-md" ondrop="drop(event, '{{ $bucket->id }}')" ondragover="allowDrop(event)">
    <div class=" flex flex-row mt-1">
        <div class="flex text-xl justify-center my-1 px-0">
            <input class="w-full text-left text-lg py-0 font-bold bg-blue-100 border-0" value="{{ $bucket->title }}" type="text" name="title" id="title" wire:model.lazy="bucketTitle" wire:change="updateBucket" />
        </div>
        <div type="button" wire:click="deleteBucket" class="cursor-pointer my-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>

    <div id="{{ $bucket->id }}" class="flex justify-center items-center w-full my-2" style="display:none;">
        <div class="animate-spin rounded-full h-4 w-4 border-t-2 mx-auto border-b-2 border-purple-500"></div>
    </div>


    @foreach($cards as $card)
    <div class="py-2 cardDraggable" draggable="true" id="{{$card->id}}" ondragstart="drag(event, '{{ $card->id }}')">
        <livewire:card-component :bucket="$bucket" :card="$card" :key="$card->id" />
    </div>
    @endforeach

    <div class="flex justify-center mt-2">
        <a href="{{ route('card.create', ['bucketid' => $bucket->id]) }}" wire:loading.attr="disabled" class="bg-gray-100 hover:bg-gray-400 text-gray-800 py-1 pl-1 pr-2 border-2 border-r-2 rounded-full inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>New Card</span>
        </a>
    </div>
</div>