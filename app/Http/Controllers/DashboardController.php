<?php

namespace App\Http\Controllers;

use App\Models\Note;

class DashboardController extends Controller
{
    public function index()
    {
        $publicNotes = Note::where('is_public', true)->with(['user', 'comments.user'])->latest()->get();

        return view('dashboard', [
            'publicNotes' => $publicNotes,
        ]);
    }
}
