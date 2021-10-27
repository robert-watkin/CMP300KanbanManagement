<x-dashboard-layout>
    <x-slot name="slot">
        <div class="flex justify-between overflow-hidden bg-white w-full h-14 shadow-sm">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight ml-6 mt-3">{{ $board->title }}</h1>
            <a href="">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mt-3 mr-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </a>
        </div>

        <div class="flex flex-col md:flex-row justify-end space-x-2 h-5/6 m-2">
            @foreach($board->buckets()->get() as $bucket)
            <livewire:bucket :bucket="$bucket" />
            @endforeach
            <div class="flex-none min-w-24 float-right text-center mx-3">
                <h1>New Bucket</h1>
            </div>
        </div>
    </x-slot>
</x-dashboard-layout>