<x-app-layout>
    <div class="p-8">
        <h1 class="text-3xl font-bold text-nostalgic-dark dark:text-warm-light">{{ $board->title }}</h1>

    <div class="my-6 p-4 bg-warm-light dark:bg-nostalgic-dark rounded-lg shadow">
        <form id="memoryForm" action="{{ route('memories.store', $board) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-text-input type="text" name="title" placeholder="Title of your memory" class="w-full mb-2" />
            <textarea id="storyInput" name="story" placeholder="Tell your story..." class="textarea textarea-bordered w-full mb-2 dark:bg-nostalgic-muted"></textarea>
            <input id="mediaInput" type="file" name="media" class="file-input file-input-bordered w-full max-w-xs mb-2">
            <p id="warningMessage" class="text-red-600 mb-2 hidden">Input your file first for make a memory</p>
            <x-primary-button>Save Memory</x-primary-button>
        </form>
        <script>
            document.getElementById('memoryForm').addEventListener('submit', function(event) {
                var story = document.getElementById('storyInput').value.trim();
                var media = document.getElementById('mediaInput').files.length;
                var warningMessage = document.getElementById('warningMessage');
                if (story === '' && media === 0) {
                    event.preventDefault();
                    warningMessage.classList.remove('hidden');
                } else {
                    warningMessage.classList.add('hidden');
                }
            });
        </script>
    </div>

    <div x-data="{ showModal: false, modalImage: '', modalTitle: '', modalStory: '' }" class="relative min-h-screen bg-warm-light dark:bg-nostalgic-dark rounded-lg p-4 bg-repeat" style="background-image: url(...);">
        @foreach ($board->memories->sortBy('created_at') as $memory)
            <div class="absolute" style="left: {{ rand(5, 85) }}%; top: {{ rand(5, 85) }}%;">
                @if ($memory->type === 'image')
                    <div class="bg-warm-light p-2 rounded shadow-lg transform -rotate-3 relative group">
                        <div @click="showModal = true; modalImage='{{ asset('storage/' . $memory->content) }}'; modalTitle='{{ $memory->title }}'; modalStory='{{ addslashes($memory->story ?? '') }}'" class="cursor-pointer">
                            <img src="{{ asset('storage/' . $memory->content) }}" alt="{{ $memory->title }}" class="max-w-xs max-h-64">
                            <p class="text-center text-sm mt-1 text-nostalgic-dark">{{ $memory->title }}</p>
                        </div>
                        <div class="absolute top-1 right-1 flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('memories.edit', [$board, $memory]) }}" title="Edit Memory" class="bg-warm-accent hover:bg-nostalgic-dark text-warm-light rounded p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2M12 7v10m-7-5h14" />
                                </svg>
                            </a>
                            <form action="{{ route('memories.destroy', [$board, $memory]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this memory?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete Memory" class="bg-warm-accent hover:bg-nostalgic-dark text-warm-light rounded p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="bg-warm-muted p-4 rounded shadow-lg transform rotate-2 max-w-xs">
                        <p class="font-semibold text-nostalgic-dark">{{ $memory->title }}</p>
                        <p>{{ $memory->content }}</p>
                    </div>
                @endif
            </div>
        @endforeach

        <!-- Modal -->
        <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50" x-transition>
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-lg w-full relative">
                <button @click="showModal = false" class="absolute top-2 right-2 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white text-2xl font-bold">&times;</button>
                <img :src="modalImage" alt="" class="w-full max-h-96 object-contain mb-4">
                <h2 class="text-xl font-bold mb-2 dark:text-white" x-text="modalTitle"></h2>
                <p class="dark:text-gray-300" x-text="modalStory"></p>
            </div>
        </div>
    </div>
    </div>
    <div class="mt-8">
    <h2 class="text-2xl font-bold mb-4 text-nostalgic-dark dark:text-warm-light">Comments</h2>

    <form action="{{ route('comments.store', $board) }}" method="POST">
        @csrf
        <textarea name="body" class="textarea textarea-bordered w-full bg-warm-muted dark:bg-nostalgic-muted" placeholder="Add a comment..."></textarea>
        <x-primary-button class="mt-2">Post</x-primary-button>
    </form>

    <div class="mt-6 space-y-4">
        @foreach($board->comments()->latest()->get() as $comment)
            <div class="p-4 bg-warm-light dark:bg-nostalgic-dark rounded-lg">
                <p class="font-semibold text-nostalgic-dark dark:text-warm-light">{{ $comment->user->name }}</p>
                <p class="text-nostalgic-muted dark:text-warm-muted">{{ $comment->body }}</p>
                <p class="text-xs text-nostalgic-muted dark:text-warm-muted mt-1">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        @endforeach
    </div>
</div>
</x-app-layout>
