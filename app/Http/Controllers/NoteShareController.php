<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\NoteShare;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NoteShareController extends Controller
{
    /**
     * Tampilkan form share catatan ke user lain.
     */
    public function create(Request $request, Note $note): View
    {
        // Pastikan hanya pemilik yang bisa share
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        $sharedUserIds = $note->shares->pluck('shared_to_id');

        $users = User::where('id', '!=', $request->user()->id)
            ->whereNotIn('id', $sharedUserIds)
            ->get();


        return view('notes.share', [
            'note' => $note,
            'users' => $users,
        ]);
    }

    /**
     * Simpan catatan yang dibagikan.
     */
    public function store(Request $request, Note $note): RedirectResponse
    {
        if ($note->user_id !== $request->user()->id) {
            abort(403);
        }

        $request->validate([
            'shared_to_id' => ['required', 'array'],
            'shared_to_id.*' => ['exists:users,id'],
        ]);

        foreach ($request->input('shared_to_id') as $userId) {
            NoteShare::firstOrCreate([
                'note_id' => $note->id,
                'shared_to_id' => $userId,
            ]);
        }

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dibagikan.');
    }

    public function destroy(Request $request, Note $note, NoteShare $noteShare): RedirectResponse
    {
        if ($note->user_id !== $request->user()->id || $noteShare->note_id !== $note->id) {
            abort(403);
        }

        $noteShare->delete();

        return back()->with('success', 'Berhasil di-unshare.');
    }
}
