<div class="flex overflow-x-scroll px-2 pl-6 h-full">
    <div class="flex flex-col md:flex-row md:justify-end h-full mx-auto md:ml-4">
        @foreach($board->buckets()->get() as $bucket)
        <div class="flex-none flex-col space-y-2 text-left w-56 mx-1">
            <livewire:bucket-component :bucket="$bucket" :key="$bucket->id" />
        </div>
        @endforeach
        @php
        $link = auth()->user()->boards()->where(['board_id' => $board->id])->first();
        @endphp
        @if ($link->role != "Viewer")
        <div class="flex-none min-w-24 float-right text-center mx-3 pt-4">
            <button type="button" wire:click="newBucket" wire:loading.attr="disabled" class="bg-gray-100 hover:bg-gray-400 text-gray-800 py-1 pl-2 pr-3 border-2 border-r-2 rounded-full inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="">New Bucket</span>
            </button>
        </div>
        @endif
    </div>

</div>

@if ($link->role != "Viewer")
@push('scripts')
<script>
    var card_id;

    function allowDrop(ev) {
        ev.preventDefault();
    }

    function drag(ev, card_id) {
        ev.dataTransfer.setData("text", ev.target.id);
        this.card_id = card_id;
    }

    function drop(ev, bucket_id) {

        ev.preventDefault();
        var data = ev.dataTransfer.getData("text");
        var card = document.getElementById(data);
        card.style.display = "none";

        var els = document.querySelectorAll('.cardDraggable');
        for (var i = 0; i < els.length; i++) {
            els[i].setAttribute("draggable", "false");
        }

        var spinner = document.getElementById(bucket_id);
        spinner.style.display = "inline";

        Livewire.emit('movingCard', [this.card_id, bucket_id]);

    }
</script>
@endpush
@endif