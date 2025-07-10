<x-app-layout>
    <div class="p-8 max-w-lg mx-auto">
        <h1 class="text-3xl font-bold mb-6 dark:text-white">Edit Memory</h1>

        <form action="{{ route('memories.update', [$board, $memory]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="title" class="block text-gray-700 dark:text-gray-300 mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $memory->title) }}" class="input input-bordered w-full mb-4 dark:bg-gray-700" />

            <label for="story" class="block text-gray-700 dark:text-gray-300 mb-2">Story</label>
            <textarea name="story" id="story" class="textarea textarea-bordered w-full mb-4 dark:bg-gray-700">{{ old('story', $memory->story) }}</textarea>

            @if ($memory->type === 'image' && $memory->content)
                <div class="mb-4">
                    <p class="text-gray-700 dark:text-gray-300 mb-2">Current Image:</p>
                    <img src="{{ asset('storage/' . $memory->content) }}" alt="{{ $memory->title }}" class="max-w-full max-h-64 rounded" />
                </div>
            @endif

            <label for="media" class="block text-gray-700 dark:text-gray-300 mb-2">Replace Image (optional)</label>
            <input type="file" name="media" id="media" class="file-input file-input-bordered w-full max-w-xs mb-4" />

            <button type="submit" class="btn btn-primary">Update Memory</button>
            <a href="{{ route('boards.show', $board) }}" class="btn btn-secondary ml-4">Cancel</a>
        </form>
    </div>
</x-app-layout>
