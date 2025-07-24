<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Catatan Publik
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($publicNotes as $note)
                <div class="bg-white p-4 rounded shadow">
                    <h3 class="text-lg font-bold">{{ $note->title }}</h3>
                    <p class="text-sm text-gray-600 mb-2">oleh {{ $note->user->name }}</p>
                    <p class="mb-3">{{ $note->content }}</p>

                    <hr class="my-3">

                    <h4 class="text-sm font-semibold mb-1">Komentar</h4>
                    <div class="space-y-2">
                        @forelse($note->comments as $comment)
                            <div class="border p-2 rounded bg-gray-50">
                                <p class="text-sm">{{ $comment->content }}</p>
                                <p class="text-xs text-gray-500">oleh {{ $comment->user->name }},
                                    {{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-gray-400">Belum ada komentar.</p>
                        @endforelse
                    </div>

                    @auth
                        <form action="{{ route('comments.store', $note) }}" method="POST" class="mt-3">
                            @csrf
                            <textarea name="content" class="w-full border rounded px-3 py-2" placeholder="Tulis komentar..." required></textarea>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-2">Kirim
                                Komentar</button>
                        </form>
                    @else
                        <p class="text-sm text-gray-500 mt-2 italic">Login untuk menulis komentar.</p>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
