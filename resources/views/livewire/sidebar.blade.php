<div class="flex flex-col justify-between bg-white w-full h-full">
    <div class="flex flex-col gap-4">
        <div class="flex flex-row items-center justify-center h-20 shadow-md">
            <!-- Notifications -->
            <div class="relative">
                <livewire:notifications />
            </div>

            <!-- Logo -->
            <div class=" items-center">
                <a href="{{ route('board.index') }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            </div>
        </div>

        <div class="px-4 mx-2">
            <!-- Settings Dropdown -->
            <div class="flex flex-col">
                <div class="relative mx-auto">
                    <x-jet-dropdown align="left" style="bottom:100%;" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <span class="inline-flex rounded-md border-2">
                                <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <div class="mt-2">
                <h1>Boards</h1>
                <ul class="mb-4 mt-2 overflow-x-hidden overflow-y-auto max-h-80">
                    <!-- TOOD Display dynamically -->
                    @if ($boardList)
                    @foreach($boardList as $board)
                    <hr />
                    <li class="my-2">
                        <a href="{{ route('board.show', ['board' => $board->id]) }}" class="flex flex-row items-center transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <p class="text-sm font-medium">{{ $board->title }}</p>
                        </a>
                    </li>
                    @endforeach
                    @else
                    <hr />
                    <li class="text-center p-2">
                        <h3>You currently aren't a member of any boards</h3>
                    </li>
                    <hr />
                    @endif
                </ul>
            </div>

            <div class="px-auto">
                <a href="{{ route('board.create')}}" class="flex flex-row justify-center w-36 g-gray-100 items-center hover:bg-gray-400 text-gray-800 mx-auto py-1 pl-2 pr-3 border-2 border-r-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="">New Board</span>
                </a>
            </div>
        </div>
    </div>

    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <!-- admin links -->
        <div>
            @if ($user->role == "Admin")
            <h1 class="">Admin</h1>
            <ul class="mb-4">
                <li class="mb-4 mt-1">
                    <a href="/admin/users" class="flex flex-row items-center h-2 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-4 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                        <span class="text-sm font-medium">User Management</span>
                    </a>
                </li>
                <li>
                    <a href="/admin/boards" class="flex flex-row items-center h-2 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-4 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                        <span class="text-sm font-medium">Board Management</span>
                    </a>
                </li>
            </ul>
            @endif
        </div>
    </div>
</div>