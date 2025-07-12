<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">My Boards</h1>

            <form action="{{ route('boards.store') }}" method="POST" class="my-4 flex items-center">
                @csrf
                <x-text-input type="text" name="title" placeholder="Create a new board title..." class="w-full max-w-xs" />
                <x-primary-button class="ml-2">Create Board</x-primary-button>
            </form>

            <form action="{{ route('boards.join') }}" method="POST" class="my-4 flex items-center">
                @csrf
                <x-text-input type="text" name="code" placeholder="Enter board code to join..." maxlength="6" class="w-full max-w-xs" />
                <x-primary-button class="ml-2">Join Board</x-primary-button>
                @error('code')
                    <p class="text-red-500 mt-1">{{ $message }}</p>
                @enderror
                @if(session('info'))
                    <p class="text-blue-500 mt-1">{{ session('info') }}</p>
                @endif
            </form>

                @if($boards->count())
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
                @foreach ($boards as $board)
                    <div class="relative bg-warm-light dark:bg-nostalgic-dark rounded-lg shadow hover:shadow-lg transition p-4">
                        <a href="{{ route('boards.show', $board) }}" class="block">
                            <h3 class="font-bold text-lg text-nostalgic-dark dark:text-warm-light">{{ $board->title }}</h3>
                            <p class="text-sm text-nostalgic-muted dark:text-warm-muted">{{ $board->memories->count() }} memories</p>
                            <p class="text-xs text-nostalgic-muted dark:text-warm-muted mt-1">Code: <span class="font-mono">{{ $board->code }}</span></p>
                        </a>
                        <div class="absolute top-2 right-2 flex space-x-2">
                            <a href="{{ route('boards.edit', $board) }}" class="inline-flex items-center btn-sm border border-warm-accent text-warm-accent rounded px-2 py-1 hover:bg-warm-accent hover:text-warm-light transition" title="Edit Board">Edit</a>
                            <form action="{{ route('boards.destroy', $board) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this board?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center btn-sm border border-warm-accent text-warm-accent rounded px-2 py-1 hover:bg-warm-accent hover:text-warm-light transition" title="Delete Board">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                 <p class="text-nostalgic-muted dark:text-warm-muted">No boards yet.</p>
                 <p class="text-nostalgic-muted dark:text-warm-muted">Create a board to start saving memories.</p>
            </div>
        @endif
    </div>
</x-app-layout>