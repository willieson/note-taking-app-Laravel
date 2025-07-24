<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class NoteController extends Controller
{
    /**
     * Tampilkan daftar catatan milik user.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        $myNotes = $user->notes()->latest()->get();

        $sharedNotes = Note::whereHas('shares', function ($query) use ($user) {
            $query->where('shared_to_id', $user->id);
        })->latest()->get();

        return view('notes.index', [
            'notes' => $myNotes,
            'sharedNotes' => $sharedNotes,
        ]);
    }

    /**
     * Tampilkan form untuk membuat catatan.
     */
    public function create(Request $request): View
    {
        return view('notes.create');
    }

    /**
     * Simpan catatan ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'content'   => ['required', 'string'],
            'is_public' => ['nullable', 'boolean'],
        ]);

        $request->user()->notes()->create([
            'title'     => $request->input('title'),
            'content'   => $request->input('content'),
            'is_public' => $request->boolean('is_public'),
        ]);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dibuat.');
    }

    /**
     * Tampilkan form edit catatan.
     */
    public function edit(Request $request, Note $note): View
    {
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        return view('notes.edit', [
            'note' => $note,
        ]);
    }

    /**
     * Update catatan.
     */
    public function update(Request $request, Note $note): RedirectResponse
    {
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        $request->validate([
            'title'     => ['required', 'string', 'max:255'],
            'content'   => ['required', 'string'],
            'is_public' => ['nullable', 'boolean'],
        ]);

        $note->update([
            'title'     => $request->input('title'),
            'content'   => $request->input('content'),
            'is_public' => $request->boolean('is_public'),
        ]);

        return Redirect::route('notes.index')->with('success', 'Catatan berhasil diperbarui.');
    }

    /**
     * Hapus catatan.
     */
    public function destroy(Request $request, Note $note): RedirectResponse
    {
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        $note->delete();

        return Redirect::route('notes.index')->with('success', 'Catatan berhasil dihapus.');
    }
}
