<div class="mt-4 mb-6">
    <!-- Members -->
    @isset($error)
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Sorry!</strong>
        <span class="block sm:inline">{{ $error }}</span>
    </div>
    @endisset

    <div class="flex flex-row justify-between mt-2">
        <x-jet-label for="members" class="flex-none ml-2 mx-4 pt-5 text-lg" value="{{ __('Members') }}" />

        <!-- Add Members -->
        <div class="flex flex-col pt-4 pb-1">
            <div class="relative">
                <x-jet-dropdown align="bottom" style="bottom:100%;" width="60">
                    <x-slot name="trigger">
                        <a class="bg-gray-100 hover:bg-gray-400 text-gray-800 cursor-pointer  py-1 pl-2 pr-3 border-2 border-r-2 rounded-full inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="">Invite Member</span>
                        </a>
                    </x-slot>

                    <x-slot name="content">
                        <div class="m-2">
                            @csrf

                            <div class="flex flex-col mb-1">
                                <x-jet-label for="email" class="flex-none ml-2 mx-4  text-sm" value="{{ __('Email') }}" />
                                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model="email" />
                            </div>

                            <div class="block text-left" style="max-width: 400px">
                                <x-jet-label for="email" class="flex-none ml-2 mx-4  text-sm" value="{{ __('Role') }}" />
                                <select name="role" wire:model="role" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full mt-1 mb-2">
                                    @foreach($roleOptions as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <x-jet-button type="button" wire:click="addMember" class="bg-blue-500 hover:bg-blue-700 text-white font-bold rounded-full" wire:loading.attr="disabled ">
                                {{ __('Invite') }}
                            </x-jet-button>

                            <div wire:loading wire:target="addMember">
                                Loading...
                            </div>
                        </div>
                    </x-slot>
                </x-jet-dropdown>
            </div>
        </div>
    </div>

    <!-- Member table -->
    <table class="bg-gray-100 border-2 rounded-lg w-full">
        <thead class="bg-blueGray-50 rounded-full">
            <tr>
                <th class="px-6 align-middle  py-3 text-xs uppercase whitespace-nowrap font-semibold text-left">Name</th>
                <th class="px-6 align-middle  py-3 text-xs uppercase whitespace-nowrap font-semibold text-left">Status</th>
                <th class="px-6 align-middle  py-3 text-xs uppercase whitespace-nowrap font-semibold text-left">Role</th>
                <th class="w-12"></th>
            </tr>
        </thead>
        @php $first = true; @endphp
        <tbody class="bg-gray-100 h-12">
            @isset($members)
            @foreach ($members as $member)
            <tr class="bg-white h-12 border">
                <td class="px-6 align-middle py-3 text-xs whitespace-nowrap font-semibold text-left">{{ $member[0] }}</td>
                <td class="px-6 align-middle py-3 text-xs whitespace-nowrap font-semibold text-left">{{ $member[1] }}</td>
                <td class="px-6 align-middle text-xs whitespace-nowrap font-semibold text-left w-12">
                    @if($first)
                    {{ $member[2] }}
                    @else
                    <select wire:model="roles.{{ $member[4] }}" wire:change="roleChange" name="role" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md text-sm h-10 shadow-sm">
                        @foreach($roleOptions as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                    <p wire:loading wire:target="roleChange" class="text-sm">
                        ...
                    </p>
                    @endif
                </td>
                <td class="flex flex-row justify-between py-3">
                    @if(!$first)
                    <button type="button" wire:click="removeMember({{ json_encode($member) }})" class="cursor-pointer mr-1 my-auto" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <p wire:loading wire:target="removeMember" class="text-sm">
                        ...
                    </p>
                    @endif
                </td>
            </tr>
            @php $first = false; @endphp
            @endforeach
            @endisset
        </tbody>
    </table>

    <input type="hidden" name="members" id="members" value="{{ json_encode($members) }}">
</div>