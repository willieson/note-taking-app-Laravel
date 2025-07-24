<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Bagikan Catatan: {{ $note->title }}</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('notes.share.store', $note) }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium text-sm">Pilih pengguna</label>
                    <select id="shared_to_id" name="shared_to_id[]" multiple class="w-full border px-3 py-2 rounded">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>

                    <small class="text-gray-500">Tekan CTRL / CMD untuk pilih lebih dari satu</small>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Bagikan</button>
            </form>
            @if ($note->shares->isNotEmpty())
                <hr class="my-6">
                <h3 class="text-lg font-semibold mb-2">Sudah dibagikan ke:</h3>

                <ul class="list-disc pl-5">
                    @foreach ($note->shares as $share)
                        <li class="flex items-center justify-between">
                            <span>{{ $share->sharedTo->name }} ({{ $share->sharedTo->email }})</span>
                            <form action="{{ route('notes.share.destroy', [$note, $share]) }}" method="POST"
                                onsubmit="return confirm('Unshare catatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-sm">Unshare</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif

        </div>
    </div>
</x-app-layout>
