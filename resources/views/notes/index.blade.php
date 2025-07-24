<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Daftar Catatan Saya</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <a href="{{ route('notes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">+ Buat Catatan</a>

            <div class="mt-4 bg-white shadow p-4 rounded">
                @forelse ($notes as $note)
                    <div class="mb-4">
                        <h3 class="text-lg font-bold">{{ $note->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $note->created_at->diffForHumans() }}</p>
                        <p>{{ Str::limit($note->content, 100) }}</p>
                        <p class="text-xs text-gray-600 mt-1">Status: {{ $note->is_public ? 'Publik' : 'Pribadi' }}</p>
                        <a href="{{ route('notes.edit', $note) }}" class="text-blue-500 text-sm mr-2">Edit</a>

                        <form action="{{ route('notes.destroy', $note) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm"
                                onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                        </form>
                        <a href="{{ route('notes.share.create', $note) }}" class="text-sm text-indigo-600">Bagikan</a>
                        @if ($note->shares->isNotEmpty())
                            <p class="text-xs text-gray-500 mt-1">
                                Dibagikan ke:
                                @foreach ($note->shares as $share)
                                    {{ $share->sharedTo->name }}{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            </p>
                        @endif



                    </div>
                    <hr class="mb-4">
                @empty
                    <p>Belum ada catatan.</p>
                @endforelse
                <h3 class="text-lg font-semibold mt-6">Catatan yang Dibagikan ke Kamu</h3>
                <div class="mt-2 bg-gray-100 p-4 rounded">
                    @forelse ($sharedNotes as $note)
                        <div class="mb-3">
                            <strong>{{ $note->title }}</strong>
                            <p class="text-sm text-gray-600">Dibagikan oleh: {{ $note->user->name }}
                                ({{ $note->user->email }})
                            </p>
                            <p>{{ Str::limit($note->content, 100) }}</p>
                        </div>
                    @empty
                        <p>Tidak ada catatan yang dibagikan.</p>
                    @endforelse
                </div>

            </div>


        </div>
    </div>
</x-app-layout>
