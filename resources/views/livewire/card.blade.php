<div class="max-w-md rounded-md bg-white overflow-auto shadow-lg mx-auto p-1 py-2">
    <h2>{{ $card->title }}</h2>
    <h3 class="font-bold">Assigned:</h3>

    @foreach($assigned as $user)
    <p class="text-sm">{{ $user->first_name }} {{ $user->last_name }}</p>
    @endforeach

    <button class="bg-blue-500 hover:bg-blue-700 text-white  font-bold px-4 rounded-full float-right">
        Open
    </button>
</div>