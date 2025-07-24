<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Catatan</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('notes.update', $note) }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block font-medium text-sm">Judul</label>
                    <input type="text" name="title" class="w-full border px-3 py-2 rounded"
                        value="{{ old('title', $note->title) }}" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium text-sm">Isi</label>
                    <textarea name="content" rows="5" class="w-full border px-3 py-2 rounded" required>{{ old('content', $note->content) }}</textarea>
                </div>

                <div class="mb-4">
                    <label>
                        <input type="checkbox" name="is_public" value="1" {{ $note->is_public ? 'checked' : '' }}>
                        Publik
                    </label>
                </div>

                <button type="submit" class="bg-yellow-600 text-white px-4 py-2 rounded">Update</button>
            </form>
        </div>
    </div>
</x-app-layout>
