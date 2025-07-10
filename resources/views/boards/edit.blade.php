<x-app-layout>
    <div class="p-8 max-w-md mx-auto">
        <h1 class="text-3xl font-bold mb-6 dark:text-white">Edit Board</h1>

        <form action="{{ route('boards.update', $board) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="title" class="block text-gray-700 dark:text-gray-300 font-semibold mb-2">Board Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $board->title) }}" required
                class="input input-bordered w-full mb-4 dark:bg-gray-700 @error('title') input-error @enderror">

            @error('title')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror

            <div class="flex justify-between">
                <a href="{{ route('boards.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Board</button>
            </div>
        </form>
    </div>
</x-app-layout>
