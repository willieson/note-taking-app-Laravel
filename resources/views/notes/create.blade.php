<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Buat Catatan Baru</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('notes.store') }}" method="POST" class="bg-white p-6 rounded shadow">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block font-medium text-sm">Judul</label>
                    <input type="text" name="title" class="w-full border px-3 py-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="content" class="block font-medium text-sm">Isi</label>
                    <textarea name="content" rows="5" class="w-full border px-3 py-2 rounded" required></textarea>
                </div>

                <div class="mb-4">
                    <label>
                        <input type="checkbox" name="is_public" value="1">
                        Buat sebagai catatan publik
                    </label>
                    <button type="submit" class="bg-green-400 text-white px-4 py-2 rounded">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
