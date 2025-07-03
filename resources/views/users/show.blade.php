<x-app-layout>
    <div class="container mx-auto p-4 md:p-8">
        
        <div class="flex items-center mb-8">
            <div class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full mr-4"></div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
                <p class="text-gray-600 dark:text-gray-400">Joined on {{ $user->created_at->toFormattedDateString() }}</p>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
            Boards by {{ $user->name }}
        </h2>

        @if($boards->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($boards as $board)
                    <a href="{{ route('boards.show', $board) }}" class="block p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300">
                        <h3 class="font-bold text-xl text-gray-900 dark:text-white">{{ $board->title }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $board->memories->count() }} memories</p>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 dark:text-gray-400 mt-4">{{ $user->name }} hasn't created any boards yet.</p>
        @endif

    </div>
</x-app-layout>