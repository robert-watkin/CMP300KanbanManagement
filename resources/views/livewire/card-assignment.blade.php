<div class="my-2">
    <x-jet-label for="assigned" class="flex-none ml-2 mx-4 text-lg" value="{{ __('Assigned') }}" />
    <div class=" pl-0 pr-48">

        @if(isset($assignedtocard))
        @php $c = 0; @endphp
        @foreach($assignedtocard as $key => $user)
        <hr />
        <div class="flex flex-row justify-between hover:bg-gray-100">
            <p class="py-auto  py-2 pl-4">{{ $user->first_name }} {{ $user->last_name }}</p>
            <div type="button" wire:click="removeUser({{ $c }})" class="cursor-pointer my-auto ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        @php $c++; @endphp
        @endforeach
        @endif

        <hr />
        <div class="flex flex-row justify-start py-2">

            <div class="flex flex-col pb-1">
                <div class="relative">
                    <x-jet-dropdown align="left" style="bottom:100%;" width="60">
                        <x-slot name="trigger">
                            <a class="bg-gray-100 hover:bg-gray-400 text-gray-800 cursor-pointer  py-1 pl-2 pr-3 border-2 border-r-2 rounded-full inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="">Assign</span>
                            </a>
                        </x-slot>

                        <x-slot name="content">
                            <div class="m-2">
                                @csrf

                                <ul>
                                    @if(!empty($members))
                                    @php $c = 0; @endphp
                                    @foreach($members as $key => $member)
                                    <hr />

                                    <li wire:click="assignUser({{ $c }})" class="hover:bg-gray-100">
                                        <p class="flex flex-row py-2 pl-1 cursor-pointer items-center  transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-8002">{{ $member->first_name}} {{ $member->last_name }}</p>
                                    </li>
                                    @php $c++; @endphp
                                    @endforeach
                                    @else
                                    <li>There are no others members on this board</li>
                                    @endif

                                </ul>


                                <div wire:loading wire:target="addUser">
                                    Loading...
                                </div>
                            </div>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>
        </div>
    </div>

    <x-jet-input-error for="assigned" class="mt-2 ml-16" />

    <input type="hidden" name="assigned" id="assigned" value="{{ json_encode($assignedtocard) }}" />
</div>