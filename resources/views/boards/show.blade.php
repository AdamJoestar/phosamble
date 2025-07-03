<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ $board->title }}</h1>

        <div class="my-6 p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
            <form action="{{ route('memories.store', $board) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="title" placeholder="Title of your memory" class="input input-bordered w-full mb-2 dark:bg-gray-700">
                <textarea name="story" placeholder="Tell your story..." class="textarea textarea-bordered w-full mb-2 dark:bg-gray-700"></textarea>
                <input type="file" name="media" class="file-input file-input-bordered w-full max-w-xs mb-2">
                <button type="submit" class="btn btn-primary">Save Memory</button>
            </form>
        </div>

        <div class="relative min-h-screen bg-amber-100 dark:bg-gray-900 rounded-lg p-4 bg-repeat" style="background-image: url(...);">@foreach ($board->memories->sortBy('created_at') as $memory)
                <div class="absolute" style="left: {{ rand(5, 85) }}%; top: {{ rand(5, 85) }}%;"> @if ($memory->type === 'image')
                        <div class="bg-white p-2 rounded shadow-lg transform -rotate-3">
                           <img src="{{ asset('storage/' . $memory->content) }}" alt="{{ $memory->title }}" class="max-w-xs max-h-64">
                           <p class="text-center text-sm mt-1">{{ $memory->title }}</p>
                        </div>
                    @else <div class="bg-yellow-200 p-4 rounded shadow-lg transform rotate-2 max-w-xs">
                            <p class="font-semibold">{{ $memory->title }}</p>
                            <p>{{ $memory->content }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <div class="mt-8">
    <h2 class="text-2xl font-bold mb-4 dark:text-white">Comments</h2>

    <form action="{{ route('comments.store', $board) }}" method="POST">
        @csrf
        <textarea name="body" class="textarea textarea-bordered w-full dark:bg-gray-700" placeholder="Add a comment..."></textarea>
        <button type="submit" class="btn btn-secondary mt-2">Post</button>
    </form>

    <div class="mt-6 space-y-4">
        @foreach($board->comments()->latest()->get() as $comment)
            <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-lg">
                <p class="font-semibold dark:text-white">{{ $comment->user->name }}</p>
                <p class="text-gray-700 dark:text-gray-300">{{ $comment->body }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        @endforeach
    </div>
</div>
</x-app-layout>