<div class="flex flex-col justify-between bg-white w-full h-full">
    <div class="flex flex-col gap-4">
        <div class="flex flex-row items-center justify-center h-20 shadow-md">
            <!-- Notifications -->
            <div class="relative">
                <x-jet-dropdown align="left" style="bottom:100%;" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </button>
                        @else
                        <span class="inline-flex rounded-md mt-3">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>
                        </span>
                        @endif
                    </x-slot>

                    <x-slot name="content">
                        <!-- TODO Notifications -->
                    </x-slot>
                </x-jet-dropdown>
            </div>

            <!-- Logo -->
            <div class=" items-center">
                <a href="{{ route('board.index') }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            </div>
        </div>

        <div class="px-6">
            <!-- Settings Dropdown -->
            <div class="flex flex-col">
                <div class="relative">
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
                <ul class="mb-4 mt-2">
                    <!-- TOOD Display dynamically -->
                    @if ($boardList)
                    @foreach($boardList as $board)
                    <li class="my-2">
                        <a href="{{ route('board.show', ['board' => $board->id]) }}" class="flex flex-row items-center h-2 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                            <span class="inline-flex items-center justify-center h-4 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                            <span class="text-sm font-medium">{{ $board->title }}</span>
                        </a>
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>

            <div>
                <button class="bg-gray-100 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 border-2 border-r-2 w-full rounded inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="">New Board</span>
                </button>
            </div>
        </div>
    </div>

    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <!-- admin links -->
        <div>
            @if ($user->role == "admin")
            <h1 class="">Admin</h1>
            <ul class="mb-4">
                <li class="mb-4 mt-1">
                    <a href="{{ route('board.index') }}" class="flex flex-row items-center h-2 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-4 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                        <span class="text-sm font-medium">User Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('board.index') }}" class="flex flex-row items-center h-2 transform hover:translate-x-2 transition-transform ease-in duration-200 text-gray-500 hover:text-gray-800">
                        <span class="inline-flex items-center justify-center h-4 text-lg text-gray-400"><i class="bx bx-home"></i></span>
                        <span class="text-sm font-medium">Board Management</span>
                    </a>
                </li>
            </ul>
            @endif
        </div>
    </div>
</div>