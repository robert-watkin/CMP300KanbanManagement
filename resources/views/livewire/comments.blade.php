<div class="my-1 p-2">
    <x-jet-label for="comments" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Comments') }}" />

    <div class="p-2">

        <!-- TODO display comments -->
        @foreach ($comments as $comment)
        <div>
            <hr />
            <div class="flex flex-row">
                <div class="flex flex-grow flex-col p-2">
                    <p>{{ $comment->comment }}</p>
                    @foreach ( $users as $user )
                    @if ($user->id == $comment->user_id)
                    <p class="text-xs text-gray-600">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</p>
                    @break
                    @endif
                    @endforeach
                </div>
                <div>
                    @foreach ( $users as $user )
                    @if (Auth::user()->id == $user->id)
                    <div type="button" wire:click="" class="cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    @break
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach


        <hr class="mb-2" />

        <div class="flex flex-row">
            <x-jet-input name="comment" id="comment" type="text" class="flex-grow overflow-y-hiden resize-none border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model.defer="commentContent"></x-jet-input>
            <div class="py-1 ml-2">
                <x-jet-button type="button" wire:click="send" class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full" wire:loading.attr="disabled ">
                    {{ __('Send') }}
                </x-jet-button>
            </div>
        </div>
    </div>