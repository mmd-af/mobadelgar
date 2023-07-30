<?php

namespace App\Models\Note;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory,
        SoftDeletes,
        NoteRelationships,
        NoteModifiers;

    protected $table = 'notes';
}
