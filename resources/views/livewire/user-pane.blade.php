@if(isset($user))
<tr>
    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">
            {{ $user->id }}
        </div>
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
        <input wire:model="firstname" value="{{$firstname}}" class="text-sm font-medium bg-white text-gray-900 @if($editable) border-2 border-r-2 @endif" @if(!$editable) disabled @endif />
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
        <input wire:model="lastname" value="{{ $user->last_name }}" class="text-sm font-medium bg-white text-gray-900 @if($editable) border-2 border-r-2 @endif" @if(!$editable) disabled @endif />
    </td>

    <td class="px-6 py-4 whitespace-nowrap ">
        <input wire:model="email" value="{{ $user->email }}" class="text-sm bg-white text-gray-500 w-52 @if($editable) border-2 border-r-8 @endif" @if(!$editable) disabled @endif />
    </td>

    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
        @if ($editable)
        <select wire:model="role" name="role" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md text-sm h-10 shadow-sm">
            @foreach($roleOptions as $roleOption)
            <option value="{{ $roleOption }}">{{ $roleOption }}</option>
            @endforeach
        </select>
        @else
        <div class="text-sm font-medium text-gray-900">
            {{ $user->role }}
        </div>
        @endif
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">
            {{ count($user->boards) }}
        </div>
    </td>

    @if(!$editable)
    <td class="px-1 py-4 whitespace-nowrap text-right text-sm font-medium">
        <button wire:click="edit" class="">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
            </svg>
        </button>
    </td>
    @else
    <td class="px-1 py-4 whitespace-nowrap text-right text-sm font-medium">
        <button wire:click="save" class="text-indigo-600 hover:text-indigo-900">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
            </svg>
        </button>
    </td>
    @endif
    <td class="px-2 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div x-data="{ open: false }">
            <button @click="open = true">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <div x-show="open" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="my-modal">
                <!--modal content-->
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div @click.away="open = false" class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Warning!</h3>
                        <div class="mt-2 px-7 py-3">
                            <p class="text-sm text-gray-500">
                                Are you sure you wish to delete this account?
                            </p>
                        </div>
                        <div class="flex flex-row justify-between space-x-2 px-4 py-3">
                            <x-jet-secondary-button @click="open = false">
                                Cancel
                            </x-jet-secondary-button>
                            <x-jet-danger-button wire:click="delete">
                                Confirm
                            </x-jet-danger-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>

</tr>
@else
<div></div>
@endif