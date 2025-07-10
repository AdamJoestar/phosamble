<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">My Boards</h1>

            <form action="{{ route('boards.store') }}" method="POST" class="my-4">
                @csrf
                <input type="text" name="title" placeholder="Create a new board title..." class="input input-bordered w-full max-w-xs dark:bg-gray-700">
                <button type="submit" class="ml-2 py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">Create Board</button>
            </form>

        @if($boards->count())
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                @foreach ($boards as $board)
                    <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition p-4">
                        <a href="{{ route('boards.show', $board) }}" class="block">
                            <h3 class="font-bold text-lg dark:text-white">{{ $board->title }}</h3>
                            <p class="text-sm text-gray-500">{{ $board->memories->count() }} memories</p>
                        </a>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <a href="{{ route('boards.edit', $board) }}" class="btn btn-sm btn-outline btn-primary" title="Edit Board">Edit</a>
                            <form action="{{ route('boards.destroy', $board) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this board?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline btn-error" title="Delete Board">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                 <p class="text-gray-500">No boards yet.</p>
                 <p class="text-gray-500">Create a board to start saving memories.</p>
            </div>
        @endif
    </div>
</x-app-layout>