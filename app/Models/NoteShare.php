<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteShare extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_id',
        'shared_to_id',
    ];
    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function sharedTo()
    {
        return $this->belongsTo(User::class, 'shared_to_id');
    }
}
